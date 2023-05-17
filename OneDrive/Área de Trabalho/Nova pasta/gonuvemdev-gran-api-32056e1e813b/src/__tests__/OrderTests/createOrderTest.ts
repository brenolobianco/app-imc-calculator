/* eslint-disable max-lines */
/* eslint-disable max-lines-per-function */
import app from '../../app';
import * as utils from '../utils';
import * as helpers from '../helpers';
import Factory from '../../factories';
import * as err from '../../middlewares/errorHandling/errors';
import { Role } from '../../enums';
import {
  AdminDocument,
  ClientDocument,
  EmployeeDocument,
  OrderInterface,
  OrderItem,
  ProductDocument,
} from '../../interfaces';
import * as gqlFieldsQuery from '../gqlFieldsQuery';
import * as checkObjects from '../checkObjects';
import * as gqlInputs from '../gqlInputs';
import { CreateOrderInput } from '../../types';

const resolver = 'createOrder';

let setupData: helpers.SetupTaskResult;

const createInput = gqlInputs.createInputCreateOrder;

const createQuery = ({ input }: { input: CreateOrderInput }): string => `
mutation {
  ${resolver}(input: ${createInput(input)}) {
    order ${gqlFieldsQuery.orderFieldsQuery}
    error ${gqlFieldsQuery.errorFieldsQuery}
  }
}`;

const baseRequest = utils.baseGqlRequest(app, createQuery);

const checkResponse = checkObjects.checkOrder;

const createFakeBody = (
  body: Partial<OrderInterface> = {},
): Required<OrderInterface> => Factory.build('Order', body);

type Ents = {
  token: string;
  seller: AdminDocument;
  intermediator: EmployeeDocument;
  client: ClientDocument;
  items: OrderItem[];
  populatedItems: OrderItem[];
};
async function createEnts(): Promise<Ents> {
  const { admin, user, token } = await helpers.createAdminUserAndToken();
  admin.user = user;

  const employee = await helpers.createEmployee({});

  const client = await helpers.createClient({});

  const finish = await helpers.createFinish({});
  const product = (await helpers.createProduct({
    body: { pricesPerFinishes: [{ finish: finish._id, price: 34500 }] },
  })) as Required<ProductDocument>;
  product.pricesPerFinishes[0].finish = finish;

  const fakeOrder = Factory.build<OrderInterface>('Order');

  await helpers.createOrder({ body: { code: '123' } });
  await helpers.createOrder({ body: { code: '99' } });

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

  return {
    token,
    seller: admin,
    intermediator: employee,
    client,
    items: [item1],
    populatedItems: [populatedItem],
  };
}

// eslint-disable-next-line max-lines-per-function
export default (): void => {
  beforeAll(async () => {
    setupData = await helpers.setupTask();
  });

  const fakeBody = createFakeBody();
  utils.testIsGqlAuthenticated(
    app,
    resolver,
    createQuery({ input: fakeBody as CreateOrderInput }),
  );

  const { rolesAllowed, rolesNotAllowed } = helpers.splitRolesByPermission([
    Role.Dev,
    Role.Admin,
  ]);

  rolesNotAllowed.forEach(role => {
    test(`403 ${role} not allowed`, () => {
      return baseRequest({ input: fakeBody }, setupData[role].token).then(
        utils.expectGqlError(err.USER_NOT_ALLOWED, resolver),
      );
    });
  });

  rolesAllowed.forEach(role => {
    test(`Not 403 - ${role} allowed`, async () => {
      return baseRequest({ input: fakeBody }, setupData[role].token).then(
        response => {
          expect(response.status).not.toBe(403);
        },
      );
    });
  });

  let ents: Ents;

  /** Verificar referências */
  test('404 Client not found', async () => {
    ents = await createEnts();

    const body = createFakeBody({
      intermediator: ents.intermediator._id,
      items: ents.items,
    });

    return baseRequest({ input: body }, ents.token).then(
      utils.expectGqlError(err.CLIENT_NOT_FOUND, resolver),
    );
  });

  test('404 Admin not found', () => {
    const body = createFakeBody({
      intermediator: ents.intermediator._id,
      client: ents.client._id,
      items: ents.items,
    });

    return baseRequest({ input: body }, setupData.admin.token).then(
      utils.expectGqlError(err.ADMIN_NOT_FOUND, resolver),
    );
  });

  test('404 Employee not found', () => {
    const body = createFakeBody({ client: ents.client._id, items: ents.items });

    return baseRequest({ input: body }, ents.token).then(
      utils.expectGqlError(err.EMPLOYEE_NOT_FOUND, resolver),
    );
  });

  test('404 Product not found', () => {
    const body = createFakeBody({
      intermediator: ents.intermediator._id,
      client: ents.client._id,
    });

    body.items[0].finish = ents.items[0].finish;

    return baseRequest({ input: body }, ents.token).then(
      utils.expectGqlError(err.PRODUCT_NOT_FOUND, resolver),
    );
  });

  test('404 Finish not found', () => {
    const body = createFakeBody({
      intermediator: ents.intermediator._id,
      client: ents.client._id,
    });

    body.items[0].product = ents.items[0].product;

    return baseRequest({ input: body }, ents.token).then(
      utils.expectGqlError(err.FINISH_NOT_FOUND, resolver),
    );
  });

  test('200 Order created', () => {
    const body = createFakeBody({
      intermediator: ents.intermediator._id,
      client: ents.client._id,
      items: ents.items,
    });

    const event = {
      date: new Date(),
      status: body.status,
      description: 'Pedido criado com esse status',
    };

    return baseRequest({ input: body }, ents.token).then(response => {
      // utils.printForDocs(response);
      const { order, error } = response.body.data[resolver];
      expect(error).toBe(null);

      expect(order.code).toBe('124');
      expect(order.events).toHaveLength(1);
      checkResponse(
        {
          ...body,
          code: '124',
          client: ents.client,
          seller: ents.seller,
          intermediator: ents.intermediator,
          items: ents.populatedItems,
          events: [event],
        },
        order,
      );
    });
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
