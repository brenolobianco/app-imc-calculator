/* eslint-disable max-lines */
/* eslint-disable max-lines-per-function */
import app from '../../app';
import Factory from '../../factories';
import * as utils from '../utils';
import * as helpers from '../helpers';
import * as err from '../../middlewares/errorHandling/errors';
import { OrderStatus, Role } from '../../enums';
import * as gqlFieldsQuery from '../gqlFieldsQuery';
import * as checkObjects from '../checkObjects';
import {
  OrderDocument,
  OrderInterface,
  ProductDocument,
} from '../../interfaces';
import { ListOrdersResponse } from '../../types';
import {
  createArgumentRest,
  createFilterTests,
  createStringValue,
  createNonStringValue,
} from '../gqlTestHelper';
import { isIDEqual } from '../../utils/general';

const resolver = 'listOrders';

let setupData: helpers.SetupTaskResult;

/** Search */
const createSearchRest = createArgumentRest('q');

/** Filters */
const createClientRest = createArgumentRest('client', createStringValue);
const createSellerRest = createArgumentRest('seller', createStringValue);
const createIntermediatorRest = createArgumentRest(
  'intermediator',
  createStringValue,
);
const createTypeRest = createArgumentRest('type', createStringValue);
const createStatusRest = createArgumentRest('status', createNonStringValue);
const createPaymentPaidRest = createArgumentRest(
  'paymentPaid',
  createNonStringValue,
);

const createQuery = ({
  page = 0,
  perPage = 5,
  sort = '-code',
  rest = '',
}): string => `
query {
  ${resolver}(page: ${page}, perPage: ${perPage}, sort: "${sort}"${rest}) {
    orders ${gqlFieldsQuery.orderFieldsQuery}
    total
    pages
    error ${gqlFieldsQuery.errorFieldsQuery}
  }
}
`;

const baseResponseExpected = utils.baseGqlListResponseExpected(
  'orders',
  resolver,
);

type Ents = { objects: OrderDocument[] };
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
      code: '789',
      seller: res1.admin._id,
      intermediator: employee1._id,
      client: client1._id,
      items: [item1],
      type: 'budget',
      status: OrderStatus.Opened,
      payment: { ...fakeOrder.payment, paid: true },
    },
  });
  o1.seller = res1.admin;
  o1.intermediator = employee1;
  o1.client = client1;
  o1.items = [populatedItem];

  const o2 = await helpers.createOrder({
    body: {
      code: '123',
      seller: res2.admin._id,
      intermediator: employee2._id,
      client: client2._id,
      items: [item1],
      type: 'order',
      status: OrderStatus.Closed,
      payment: { ...fakeOrder.payment, paid: true },
    },
  });
  o2.seller = res2.admin;
  o2.intermediator = employee2;
  o2.client = client2;
  o2.items = [populatedItem];

  const o3 = await helpers.createOrder({
    body: {
      code: '4560',
      seller: res3.admin._id,
      intermediator: employee3._id,
      client: client3._id,
      items: [item1],
      type: 'budget',
      status: OrderStatus.Measurement,
      payment: { ...fakeOrder.payment, paid: false },
    },
  });
  o3.seller = res3.admin;
  o3.intermediator = employee3;
  o3.client = client3;
  o3.items = [populatedItem];

  const objects = [o1, o2, o3];

  return { objects };
};

const baseRequest = utils.baseGqlRequest(app, createQuery);

const checkResponse = (
  expected: OrderDocument,
  received: OrderDocument,
): void => {
  checkObjects.checkOrder(expected as Required<OrderInterface>, received);
  expect(received).toMatchObject({
    _id: expected._id.toString(),
    createdAt: expected.createdAt.toISOString(),
    updatedAt: expected.updatedAt.toISOString(),
  });
};

// eslint-disable-next-line max-lines-per-function
export default (): void => {
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

  test('404 Orders empty list', () => {
    return baseRequest({}, setupData.dev.token).then(
      utils.expectGqlError(err.ORDERS_EMPTY_LIST, resolver),
    );
  });

  let ents: Ents;
  test('200 Orders found', async () => {
    ents = await createEnts();
    return baseRequest({}, setupData.dev.token).then(response => {
      // utils.printForDocs(response)
      baseResponseExpected(response);
    });
  });

  const sortTests = [
    {
      sort: 'code',
      func: (a: any, b: any): number =>
        utils.sortByNumberAsc(Number(a.code), Number(b.code)),
    },
    {
      sort: '-code',
      func: (a: any, b: any): number =>
        utils.sortByNumberDesc(Number(a.code), Number(b.code)),
    },
    {
      sort: 'date',
      func: (a: any, b: any): number => utils.sortByDateAsc(a.date, b.date),
    },
    {
      sort: '-date',
      func: (a: any, b: any): number => utils.sortByDateDesc(a.date, b.date),
    },
  ];
  const defaultSort = sortTests[1];
  sortTests.forEach(t => {
    test(`200 Orders found - test sort by ${t.sort}`, () => {
      const sorted = ents.objects.sort(t.func);
      return baseRequest({ sort: t.sort }, setupData.dev.token).then(
        response => {
          // utils.printForDocs(response.body);
          baseResponseExpected(response);
          const { orders } = response.body.data[resolver] as ListOrdersResponse;
          orders.forEach((obj, i) => {
            checkResponse(sorted[i], obj);
          });
        },
      );
    });
  });

  test('200 Orders found - test paginate', () => {
    const sorted = ents.objects.sort(defaultSort.func);
    return baseRequest({ page: 1, perPage: 2 }, setupData.dev.token).then(
      response => {
        baseResponseExpected(response, 3, 2);
        const { orders } = response.body.data[resolver] as ListOrdersResponse;
        orders.forEach((obj, i) => {
          checkResponse(sorted[i + 2], obj);
        });
      },
    );
  });

  const searchTests = [
    { field: 'code', q: '123' },
    { field: 'code', q: '456' },
    { field: 'code', q: '789' },
  ];
  searchTests.forEach(({ field, q }) => {
    test(`200 Orders found - search by ${field} with q=${q}`, () => {
      const rest = createSearchRest(q);

      const expected = ents.objects
        .filter((o: any) => o[field].search(new RegExp(q, 'gi')) !== -1)
        .sort(defaultSort.func);

      return baseRequest({ rest }, setupData.dev.token).then(response => {
        baseResponseExpected(response, expected.length, 1);
        const { orders } = response.body.data[resolver] as ListOrdersResponse;
        orders.forEach((obj, i) => {
          checkResponse(expected[i], obj);
        });
      });
    });
  });

  const filterTests = [
    ...createFilterTests(
      'client',
      createClientRest,
      (value: any) => (o: any): boolean => isIDEqual(o.client._id, value),
      [0, 1, 2],
    ),
    ...createFilterTests(
      'seller',
      createSellerRest,
      (value: any) => (o: any): boolean => isIDEqual(o.seller._id, value),
      [0, 1, 2],
    ),
    ...createFilterTests(
      'intermediator',
      createIntermediatorRest,
      (value: any) => (o: any): boolean =>
        isIDEqual(o.intermediator._id, value),
      [0, 1, 2],
    ),
    ...createFilterTests(
      'type',
      createTypeRest,
      (value: any) => (o: any): boolean => o.type === value,
      ['budget', 'order'],
    ),
    ...createFilterTests(
      'status',
      createStatusRest,
      (value: any) => (o: any): boolean => o.status === value,
      [OrderStatus.Opened, OrderStatus.Closed, OrderStatus.Measurement],
    ),
    ...createFilterTests(
      'paymentPaid',
      createPaymentPaidRest,
      (value: any) => (o: any): boolean => o.payment.paid === value,
      [true, false],
    ),
  ];
  filterTests.forEach(({ field, value, createRest, filterFunc }) => {
    test(`200 Orders found - filter by ${field} ${value}`, () => {
      const isIdFilter = typeof value === 'number';

      const newValue = isIdFilter
        ? ents.objects[value as number].get(field)._id.toString()
        : value;

      const rest = createRest(newValue);

      const expected = ents.objects
        .filter(filterFunc(newValue))
        .sort(defaultSort.func);

      return baseRequest({ rest }, setupData.admin.token).then(response => {
        // utils.printForDocs(response);
        baseResponseExpected(response, expected.length, 1);
        const { orders } = response.body.data[resolver] as ListOrdersResponse;
        orders.forEach((obj, i) => {
          checkResponse(expected[i], obj);
        });
      });
    });
  });

  afterAll(async () => {
    await helpers.dropCollections([
      'Order',
      'User',
      'Client',
      'Admin',
      'Employee',
      'Product',
      'Finish',
    ]);
  });
};
