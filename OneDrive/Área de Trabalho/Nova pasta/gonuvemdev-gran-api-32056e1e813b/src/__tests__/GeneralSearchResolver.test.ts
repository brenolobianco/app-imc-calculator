/* eslint-disable max-lines */
/* eslint-disable max-lines-per-function */
import app from '../app';
import * as utils from './utils';
import * as helpers from './helpers';
import * as err from '../middlewares/errorHandling/errors';
import { Role } from '../enums';
import * as gqlFieldsQuery from './gqlFieldsQuery';
import { OrderDocument, OrderInterface } from '../interfaces';
import { GeneralSearchParams, GeneralSearchResponse } from '../types';
import Factory from '../factories';

const resolver = 'generalSearch';

let setupData: helpers.SetupTaskResult;

const createQuery = ({ q = 'any' }: Partial<GeneralSearchParams>): string => `
query {
  ${resolver}(q: "${q}") {
    budgets ${gqlFieldsQuery.orderFieldsQuery}
    clients ${gqlFieldsQuery.clientFieldsQuery}
    error ${gqlFieldsQuery.errorFieldsQuery}
  }
}
`;

type Ents = { objects: OrderDocument[] };
const createEnts = async (): Promise<Ents> => {
  const fakeOrder = Factory.build<OrderInterface>('Order');

  const [user1, user2, user3] = await Promise.all([
    helpers.createUser({
      body: { name: 'Tiago', email: 'tiago@gmail.com', roles: [Role.Admin] },
    }),
    helpers.createUser({
      body: { name: 'Lucas', email: 'lucas@hotmail.com', roles: [Role.Admin] },
    }),
    helpers.createUser({
      body: { name: 'Maria', email: 'maria@yahoo.com', roles: [Role.Admin] },
    }),
  ]);

  const [seller1, seller2, seller3] = await Promise.all([
    helpers.createAdmin({ body: { user: user1._id } }),
    helpers.createAdmin({ body: { user: user2._id } }),
    helpers.createAdmin({ body: { user: user3._id } }),
  ]);

  const [client1, client2, client3] = await Promise.all([
    helpers.createClient({
      body: {
        name: 'Levi',
        primaryPhone: '1111122222',
        secondaryPhones: ['3333344444'],
      },
    }),
    helpers.createClient({
      body: {
        name: 'Josias',
        primaryPhone: '5555566666',
        secondaryPhones: ['8888899999'],
      },
    }),
    helpers.createClient({
      body: {
        name: 'Rute',
        primaryPhone: '1234567890',
        secondaryPhones: ['0123456789'],
      },
    }),
  ]);

  const [intermediator1, intermediator2, intermediator3] = await Promise.all([
    helpers.createEmployee({ body: { name: 'David', cpf: '125634978' } }),
    helpers.createEmployee({ body: { name: 'Saul', cpf: '135792288' } }),
    helpers.createEmployee({ body: { name: 'Samuel', cpf: '024683377' } }),
  ]);

  const [finish1, finish2, finish3] = await Promise.all([
    helpers.createFinish({ body: { code: 'G-24' } }),
    helpers.createFinish({ body: { code: 'G-35' } }),
    helpers.createFinish({ body: { code: 'G-49' } }),
  ]);

  const [product1, product2, product3] = await Promise.all([
    helpers.createProduct({ body: { name: 'CUBA' } }),
    helpers.createProduct({ body: { name: 'COMPACTSTONE' } }),
    helpers.createProduct({ body: { name: 'ALASKA WHITE' } }),
  ]);

  const [order1, order2, order3] = await Promise.all([
    helpers.createOrder({
      body: {
        code: '0120',
        type: 'budget',
        seller: seller1._id,
        client: client1._id,
        intermediator: intermediator1._id,
        items: [
          { ...fakeOrder.items[0], product: product1._id, finish: finish1._id },
        ],
      },
    }),
    helpers.createOrder({
      body: {
        code: '0124',
        type: 'budget',
        seller: seller2._id,
        client: client2._id,
        intermediator: intermediator2._id,
        items: [
          { ...fakeOrder.items[0], product: product2._id, finish: finish2._id },
        ],
      },
    }),
    helpers.createOrder({
      body: {
        code: '0125',
        type: 'budget',
        seller: seller3._id,
        client: client3._id,
        intermediator: intermediator3._id,
        items: [
          { ...fakeOrder.items[0], product: product3._id, finish: finish3._id },
        ],
      },
    }),
  ]);

  return { objects: [order1, order2, order3] };
};

const baseRequest = utils.baseGqlRequest(app, createQuery);

describe('Test generalSearch Resolver', () => {
  beforeAll(async () => {
    setupData = await helpers.setupTask();
  });

  utils.testIsGqlAuthenticated(app, resolver, createQuery({}));

  const { rolesAllowed, rolesNotAllowed } = helpers.splitRolesByPermission([
    Role.Dev,
    Role.Admin,
  ]);

  rolesNotAllowed.forEach(role => {
    test(`403 ${role} not allowed`, () => {
      return baseRequest({}, setupData[role].token).then(
        utils.expectGqlError(err.USER_NOT_ALLOWED, resolver),
      );
    });
  });

  rolesAllowed.forEach(role => {
    test(`Not 403 - ${role} allowed`, () => {
      return baseRequest({}, setupData[role].token).then(response => {
        expect(response.status).not.toBe(403);
      });
    });
  });

  let ents: Ents;
  test('200 Budgets and client found - q=lucas', async () => {
    ents = await createEnts();

    return baseRequest({ q: 'rute' }, setupData.dev.token).then(response => {
      // utils.printForDocs(response.body);
      const data = response.body.data[resolver] as GeneralSearchResponse;
      expect(data.budgets).toHaveLength(1);
      expect(data.clients).toHaveLength(1);
    });
  });

  const sellerTests = [
    { field: 'name', q: 'tiago', idx: 0 },
    { field: 'name', q: 'lucas', idx: 1 },
    { field: 'name', q: 'maria', idx: 2 },
    { field: 'email', q: 'gmail', idx: 0 },
    { field: 'email', q: 'hotmail', idx: 1 },
    { field: 'email', q: 'yahoo', idx: 2 },
  ];

  sellerTests.forEach(({ field, q, idx }) => {
    test(`200 Budgets found - search by ${field} with q=${q}`, () => {
      const expected = ents.objects[idx];

      return baseRequest({ q }, setupData.dev.token).then(response => {
        // utils.printForDocs(response.body);
        const { budgets, clients } = response.body.data[
          resolver
        ] as GeneralSearchResponse;
        expect(budgets).toHaveLength(1);
        expect(budgets[0]).toMatchObject({
          code: expected.code,
        });
        expect(clients).toHaveLength(0);
      });
    });
  });

  const clientsTests = [
    { field: 'name', q: 'levi', idx: 0 },
    { field: 'name', q: 'josias', idx: 1 },
    { field: 'name', q: 'rute', idx: 2 },
    { field: 'primaryPhone', q: '11111', idx: 0 },
    { field: 'primaryPhone', q: '55555', idx: 1 },
    { field: 'primaryPhone', q: '12345', idx: 2 },
    { field: 'secondaryPhones', q: '33333', idx: 0 },
    { field: 'secondaryPhones', q: '88888', idx: 1 },
    { field: 'secondaryPhones', q: '01234', idx: 2 },
  ];

  clientsTests.forEach(({ field, q, idx }) => {
    test(`200 Budgets found - search by ${field} with q=${q}`, () => {
      const expected = ents.objects[idx];

      return baseRequest({ q }, setupData.dev.token).then(response => {
        // utils.printForDocs(response.body);
        const { budgets, clients } = response.body.data[
          resolver
        ] as GeneralSearchResponse;
        expect(budgets).toHaveLength(1);
        expect(budgets[0]).toMatchObject({
          code: expected.code,
        });
        expect(clients).toHaveLength(1);
      });
    });
  });

  const intermediatorsTests = [
    { field: 'name', q: 'davi', idx: 0 },
    { field: 'name', q: 'saul', idx: 1 },
    { field: 'name', q: 'samuel', idx: 2 },
    { field: 'cpf', q: '1256', idx: 0 },
    { field: 'cpf', q: '1357', idx: 1 },
    { field: 'cpf', q: '0246', idx: 2 },
  ];

  intermediatorsTests.forEach(({ field, q, idx }) => {
    test(`200 Budgets found - search by ${field} with q=${q}`, () => {
      const expected = ents.objects[idx];

      return baseRequest({ q }, setupData.dev.token).then(response => {
        // utils.printForDocs(response.body);
        const { budgets, clients } = response.body.data[
          resolver
        ] as GeneralSearchResponse;
        expect(budgets).toHaveLength(1);
        expect(budgets[0]).toMatchObject({
          code: expected.code,
        });
        expect(clients).toHaveLength(0);
      });
    });
  });

  const finishesTests = [
    { field: 'code', q: 'G-24', idx: 0 },
    { field: 'code', q: 'G-35', idx: 1 },
    { field: 'code', q: 'G-49', idx: 2 },
  ];

  finishesTests.forEach(({ field, q, idx }) => {
    test(`200 Budgets found - search by ${field} with q=${q}`, () => {
      const expected = ents.objects[idx];

      return baseRequest({ q }, setupData.dev.token).then(response => {
        // utils.printForDocs(response.body);
        const { budgets, clients } = response.body.data[
          resolver
        ] as GeneralSearchResponse;
        expect(budgets).toHaveLength(1);
        expect(budgets[0]).toMatchObject({
          code: expected.code,
        });
        expect(clients).toHaveLength(0);
      });
    });
  });

  const productsTests = [
    { field: 'name', q: 'cuba', idx: 0 },
    { field: 'name', q: 'compact', idx: 1 },
    { field: 'name', q: 'alaska', idx: 2 },
  ];

  productsTests.forEach(({ field, q, idx }) => {
    test(`200 Budgets found - search by ${field} with q=${q}`, () => {
      const expected = ents.objects[idx];

      return baseRequest({ q }, setupData.dev.token).then(response => {
        // utils.printForDocs(response.body);
        const { budgets, clients } = response.body.data[
          resolver
        ] as GeneralSearchResponse;
        expect(budgets).toHaveLength(1);
        expect(budgets[0]).toMatchObject({
          code: expected.code,
        });
        expect(clients).toHaveLength(0);
      });
    });
  });

  const ordersTests = [
    { field: 'code', q: '0120', idx: 0 },
    { field: 'code', q: '0124', idx: 1 },
    { field: 'code', q: '0125', idx: 2 },
  ];

  ordersTests.forEach(({ field, q, idx }) => {
    test(`200 Budgets found - search by ${field} with q=${q}`, () => {
      const expected = ents.objects[idx];

      return baseRequest({ q }, setupData.dev.token).then(response => {
        // utils.printForDocs(response.body);
        const { budgets, clients } = response.body.data[
          resolver
        ] as GeneralSearchResponse;
        expect(budgets).toHaveLength(1);
        expect(budgets[0]).toMatchObject({
          code: expected.code,
        });
        expect(clients).toHaveLength(0);
      });
    });
  });

  afterAll(async () => {
    await helpers.dropCollections([
      'Product',
      'User',
      'Admin',
      'Client',
      'Employee',
      'Finish',
      'Order',
    ]);
  });
});
