/* eslint-disable max-lines-per-function */
import { Types } from 'mongoose';

import app from '../../app';
import * as utils from '../utils';
import * as helpers from '../helpers';
import Factory from '../../factories';
import * as err from '../../middlewares/errorHandling/errors';
import { Role } from '../../enums';
import { OrderInterface, ProductDocument } from '../../interfaces';
import * as gqlFieldsQuery from '../gqlFieldsQuery';
import Order from '../../models/Order';

const resolver = 'duplicateBudget';

const fakeId = Types.ObjectId().toHexString();

let setupData: helpers.SetupTaskResult;

const createQuery = ({ id }: { id: string }): string => `
mutation {
  ${resolver}(id: "${id}") {
    order ${gqlFieldsQuery.orderFieldsQuery}
    error ${gqlFieldsQuery.errorFieldsQuery}
  }
}`;

const baseRequest = utils.baseGqlRequest(app, createQuery);

const createFakeBody = (
  body: Partial<OrderInterface> = {},
): Required<OrderInterface> =>
  Factory.build<Required<OrderInterface>>('Order', body);

// eslint-disable-next-line max-lines-per-function
export default (): void => {
  beforeAll(async () => {
    setupData = await helpers.setupTask();
  });

  const fakeBody = createFakeBody();
  utils.testIsGqlAuthenticated(app, resolver, createQuery({ id: fakeId }));

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

  test('404 Order not found - wrong id', async () => {
    return baseRequest({ id: fakeId }, setupData.dev.token).then(
      utils.expectGqlError(err.ORDER_NOT_FOUND, resolver),
    );
  });

  test('404 Order not found - not a budget', async () => {
    const order = await helpers.createOrder({ body: { type: 'order' } });

    return baseRequest({ id: order._id }, setupData.dev.token).then(
      utils.expectGqlError(err.ORDER_NOT_FOUND, resolver),
    );
  });

  test('200 Order duplicated', async () => {
    const { admin, user } = await helpers.createAdminUserAndToken();
    admin.user = user;

    const employee = await helpers.createEmployee({});

    const client = await helpers.createClient({});

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

    const order = await helpers.createOrder({
      body: {
        type: 'budget',
        intermediator: employee._id,
        client: client._id,
        items: [item1],
        seller: admin._id,
      },
    });

    return baseRequest({ id: order._id }, setupData.dev.token).then(
      async response => {
        // utils.printForDocs(response);
        const { order: duplicated, error } = response.body.data[resolver];
        expect(error).toBe(null);

        expect(order._id.toString()).not.toBe(duplicated?._id.toString());
        expect(order.code).not.toBe(duplicated?.code);

        expect(duplicated).toMatchObject({
          sellerCommission: order.sellerCommission,
          intermediatorCommission: order.intermediatorCommission,
          type: order.type,
          status: order.status,
          deliveryTime: order.deliveryTime,
          comments: order.comments,
          nfe: order.nfe,
          total: order.total,
          date: order.date.toISOString(),
          expectedDeliveryDate: order.expectedDeliveryDate?.toISOString(),
          budgetExpiryDate: order.budgetExpiryDate?.toISOString(),
          assemblySchedulingDate: order.assemblySchedulingDate?.toISOString(),
          furnitureAssemblyDate: order.furnitureAssemblyDate?.toISOString(),
        });
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
