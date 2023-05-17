/* eslint-disable max-lines */
/* eslint-disable max-lines-per-function */
import { Types } from 'mongoose';

import app from '../../app';
import * as utils from '../utils';
import * as helpers from '../helpers';
import Factory from '../../factories';
import * as err from '../../middlewares/errorHandling/errors';
import { OrderStatus, Role } from '../../enums';
import {
  ClientDoc,
  EmployeeDoc,
  OrderDocument,
  OrderInterface,
  OrderItem,
  ProductDocument,
} from '../../interfaces';
import * as gqlFieldsQuery from '../gqlFieldsQuery';
import * as checkObjects from '../checkObjects';
import { UpdateOrderInput } from '../../types';
import * as gqlInputs from '../gqlInputs';
import { ORDER_TYPE_CANNOT_BE_CHANGED_TO_BUDGET } from '../../middlewares/errorHandling/errors';

const resolver = 'updateOrder';

const fakeId = Types.ObjectId().toHexString();

let setupData: helpers.SetupTaskResult;

const createInput = gqlInputs.createInputUpdateOrder;

const createQuery = ({
  id,
  input,
}: {
  id: string;
  input: Required<UpdateOrderInput>;
}): string => `
mutation {
  ${resolver}(id: "${id}", input: ${createInput(input)}) {
    order ${gqlFieldsQuery.orderFieldsQuery}
    error ${gqlFieldsQuery.errorFieldsQuery}
  }
}`;

const baseRequest = utils.baseGqlRequest(app, createQuery);

const checkResponse = (
  expected: OrderDocument,
  received: OrderDocument,
): void => {
  checkObjects.checkOrder(expected as Required<OrderInterface>, received);
  expect(received).toMatchObject({
    _id: expected._id.toString(),
  });
};

const createFakeBody = (
  body: Partial<OrderInterface> = {},
): Required<OrderInterface> =>
  Factory.build<Required<OrderInterface>>('Order', body);

type Ents = {
  objects: OrderDocument[];
  items: OrderItem[];
  populatedItems: OrderItem[];
};
const createEnts = async (): Promise<Ents> => {
  const [res1, res2, res3] = await Promise.all([
    helpers.createAdminUserAndToken(),
    helpers.createAdminUserAndToken(),
    helpers.createAdminUserAndToken(),
  ]);
  res1.admin.user = res1.user;
  res2.admin.user = res2.user;
  res3.admin.user = res3.user;

  const [employee1, employee2, employee3] = await Promise.all([
    helpers.createEmployee({}),
    helpers.createEmployee({}),
    helpers.createEmployee({}),
  ]);

  const [client1, client2, client3] = await Promise.all([
    helpers.createClient({}),
    helpers.createClient({}),
    helpers.createClient({}),
  ]);

  const finish = await helpers.createFinish({});
  const product = (await helpers.createProduct({
    body: { pricesPerFinishes: [{ finish: finish._id, price: 34500 }] },
  })) as Required<ProductDocument>;
  product.pricesPerFinishes[0].finish = finish;

  const fakeOrder = Factory.build<OrderInterface>('Order');

  const item1 = {
    ...fakeOrder.items[0],
    product: product._id,
    finish: finish._id,
  };

  const populatedItem = {
    ...fakeOrder.items[0],
    product,
    finish,
  };

  const o1 = await helpers.createOrder({
    body: {
      seller: res1.admin._id,
      intermediator: employee1._id,
      client: client1._id,
      items: [item1],
      type: 'budget',
      status: OrderStatus.Opened,
    },
  });
  o1.seller = res1.admin;
  o1.intermediator = employee1;
  o1.client = client1;
  o1.items = [populatedItem];

  const o2 = await helpers.createOrder({
    body: {
      seller: res2.admin._id,
      intermediator: employee2._id,
      client: client2._id,
      items: [item1],
    },
  });
  o2.seller = res2.admin;
  o2.intermediator = employee2;
  o2.client = client2;
  o2.items = [populatedItem];

  const o3 = await helpers.createOrder({
    body: {
      seller: res3.admin._id,
      intermediator: employee3._id,
      client: client3._id,
      items: [item1],
      type: 'order',
    },
  });
  o3.seller = res3.admin;
  o3.intermediator = employee3;
  o3.client = client3;
  o3.items = [populatedItem];

  const objects = [o1, o2, o3];

  return { objects, items: [item1], populatedItems: [populatedItem] };
};

// eslint-disable-next-line max-lines-per-function
export default (): void => {
  beforeAll(async () => {
    setupData = await helpers.setupTask();
  });

  const fakeBody = createFakeBody();
  utils.testIsGqlAuthenticated(
    app,
    resolver,
    createQuery({ id: fakeId, input: fakeBody as Required<UpdateOrderInput> }),
  );

  const { rolesAllowed, rolesNotAllowed } = helpers.splitRolesByPermission([
    Role.Dev,
    Role.Admin,
  ]);

  rolesNotAllowed.forEach(role => {
    test(`403 ${role} not allowed`, () => {
      return baseRequest(
        { id: fakeId, input: fakeBody },
        setupData[role].token,
      ).then(utils.expectGqlError(err.USER_NOT_ALLOWED, resolver));
    });
  });

  rolesAllowed.forEach(role => {
    test(`Not 403 - ${role} allowed`, () => {
      return baseRequest(
        { id: fakeId, input: fakeBody },
        setupData[role].token,
      ).then(response => {
        expect(response.status).not.toBe(403);
      });
    });
  });

  test('404 Order not found - no order', async () => {
    const body = createFakeBody();

    return baseRequest({ id: fakeId, input: body }, setupData.dev.token).then(
      utils.expectGqlError(err.ORDER_NOT_FOUND, resolver),
    );
  });

  let ents: Ents;
  test('404 Order not found - wrong id', async () => {
    ents = await createEnts();
    const body = createFakeBody();
    return baseRequest({ id: fakeId, input: body }, setupData.dev.token).then(
      utils.expectGqlError(err.ORDER_NOT_FOUND, resolver),
    );
  });

  test('422 Order type can be changed to budget', () => {
    const object = ents.objects[2];
    const id = object._id.toString();

    const body = createFakeBody({
      intermediator: (object.intermediator as EmployeeDoc)._id,
      client: (object.client as ClientDoc)._id,
      type: 'budget',
      items: ents.items,
    });

    return baseRequest({ id, input: body }, setupData.dev.token).then(
      response => {
        const { error } = response.body.data[resolver];
        expect(error).toBe(null);
      },
    );
  });

  test('404 Client not found', async () => {
    const object = ents.objects[0];
    const id = object._id.toString();

    const body = createFakeBody({
      intermediator: (object.intermediator as EmployeeDoc)._id,
      items: ents.items,
    });

    return baseRequest({ id, input: body }, setupData.dev.token).then(
      utils.expectGqlError(err.CLIENT_NOT_FOUND, resolver),
    );
  });

  test('404 Employee not found', () => {
    const object = ents.objects[0];
    const id = object._id.toString();

    const body = createFakeBody({
      client: (object.client as ClientDoc)._id,
      items: ents.items,
    });

    return baseRequest({ id, input: body }, setupData.dev.token).then(
      utils.expectGqlError(err.EMPLOYEE_NOT_FOUND, resolver),
    );
  });

  test('404 Product not found', () => {
    const object = ents.objects[0];
    const id = object._id.toString();

    const body = createFakeBody({});

    body.items[0].finish = ents.items[0].finish;

    return baseRequest({ id, input: body }, setupData.dev.token).then(
      utils.expectGqlError(err.PRODUCT_NOT_FOUND, resolver),
    );
  });

  test('404 Finish not found', () => {
    const object = ents.objects[0];
    const id = object._id.toString();

    const body = createFakeBody({});

    body.items[0].product = ents.items[0].product;

    return baseRequest({ id, input: body }, setupData.dev.token).then(
      utils.expectGqlError(err.FINISH_NOT_FOUND, resolver),
    );
  });

  test('200 Order updated', async () => {
    const object = ents.objects[0];
    const id = object._id.toString();

    const body = createFakeBody({
      intermediator: (ents.objects[1].intermediator as EmployeeDoc)._id,
      client: (ents.objects[1].client as ClientDoc)._id,
      status: OrderStatus.Measurement,
      items: ents.items,
    });

    return baseRequest({ id, input: body }, setupData.dev.token).then(
      response => {
        // utils.printForDocs(response);
        const { order, error } = response.body.data[resolver];
        expect(error).toBe(null);
        expect(order.events).toHaveLength(object.events.length + 1);
        const expected = {
          ...object.toJSON(),
          ...({
            type: body.type,
            furnitureAssemblyDate: body.furnitureAssemblyDate,
            serviceOrder: body.serviceOrder,
            status: body.status,
            assemblySchedulingDate: body.assemblySchedulingDate,
            comments: body.comments,
            nfe: body.nfe,
            payment: body.payment,
            events: order.events,
            items: ents.populatedItems,
            total: order.total,
            expectedDeliveryDate: body.expectedDeliveryDate,
            budgetExpiryDate: body.budgetExpiryDate,
            intermediatorCommission: order.intermediatorCommission,
            deliveryTime: body.deliveryTime,
            sellerCommission: body.sellerCommission,
            date: body.date,
            intermediator: ents.objects[1].intermediator,
            client: ents.objects[1].client,
            discountTotal: body.discountTotal,
            additionTotal: body.additionTotal,
            discountTotalPercentage: body.discountTotalPercentage,
            additionTotalPercentage: body.additionTotalPercentage,
            blueprint: body.blueprint,
          } as UpdateOrderInput),
        };
        checkResponse(expected, order);
      },
    );
  });

  afterAll(async () => {
    await helpers.dropCollections([
      'User',
      'Order',
      'Client',
      'Product',
      'Finish',
      'Admin',
      'Employee',
    ]);
  });
};
