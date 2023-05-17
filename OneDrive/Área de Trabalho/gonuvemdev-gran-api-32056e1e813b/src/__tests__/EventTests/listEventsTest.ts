/* eslint-disable max-lines */
/* eslint-disable max-lines-per-function */
import app from '../../app';
import * as utils from '../utils';
import * as helpers from '../helpers';
import * as err from '../../middlewares/errorHandling/errors';
import { Role } from '../../enums';
import * as gqlFieldsQuery from '../gqlFieldsQuery';
import * as checkObjects from '../checkObjects';
import {
  EventDocument,
  EventInterface,
  OrderInterface,
  ProductDocument,
} from '../../interfaces';
import { ListEventsResponse } from '../../types';
import {
  createArgumentRest,
  createFilterTests,
  createStringValue,
  createNonStringValue,
} from '../gqlTestHelper';
import Factory from '../../factories';
import { isIDEqual } from '../../utils/general';

const resolver = 'listEvents';

let setupData: helpers.SetupTaskResult;

/** Search */
const createSearchRest = createArgumentRest('q');

/** Filters */
const createDateIntervalRest = createArgumentRest(
  'dateInterval',
  (value: any) => `{
    beginDate: "${value.beginDate.toISOString()}",
    endDate: "${value.endDate.toISOString()}"
  }`,
);

const createIsPendingRest = createArgumentRest(
  'isPending',
  createNonStringValue,
);

const createOrderRest = createArgumentRest('order', createStringValue);

const createClientRest = createArgumentRest('client', createStringValue);

const createEmployeeRest = createArgumentRest('employee', createStringValue);

const createQuery = ({
  page = 0,
  perPage = 5,
  sort = 'beginDate',
  rest = '',
}): string => `
query {
  ${resolver}(page: ${page}, perPage: ${perPage}, sort: "${sort}"${rest}) {
    events ${gqlFieldsQuery.eventFieldsQuery}
    total
    pages
    error ${gqlFieldsQuery.errorFieldsQuery}
  }
}
`;

const baseResponseExpected = utils.baseGqlListResponseExpected(
  'events',
  resolver,
);

type Ents = { objects: EventDocument[] };
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

  const order1 = await helpers.createOrder({
    body: {
      seller: res1.admin._id,
      intermediator: employee1._id,
      client: client1._id,
      items: [item1],
    },
  });
  order1.seller = res1.admin;
  order1.intermediator = employee1;
  order1.client = client1;
  order1.items = [populatedItem];

  const order2 = await helpers.createOrder({
    body: {
      seller: res2.admin._id,
      intermediator: employee2._id,
      client: client2._id,
      items: [item1],
    },
  });
  order2.seller = res2.admin;
  order2.intermediator = employee2;
  order2.client = client2;
  order2.items = [populatedItem];

  const order3 = await helpers.createOrder({
    body: {
      seller: res3.admin._id,
      intermediator: employee3._id,
      client: client3._id,
      items: [item1],
    },
  });
  order3.seller = res3.admin;
  order3.intermediator = employee3;
  order3.client = client3;
  order3.items = [populatedItem];

  const now = Date.now();

  const o1 = await helpers.createEvent({
    body: {
      client: client1._id,
      order: order1._id,
      sourceEvent: undefined,
      employees: [employee1._id],
      title: 'Montagem da cuba',
      isPending: false,
      beginDate: new Date(now + 1000 * 60 * 60 * 24 * 30),
      endDate: new Date(now + 1000 * 60 * 60 * 24 * 35),
    },
  });
  o1.client = client1;
  o1.order = order1;
  o1.employees = [employee1];

  const o2 = await helpers.createEvent({
    body: {
      client: client2._id,
      order: order2._id,
      sourceEvent: o1._id,
      employees: [employee2._id],
      title: 'Conserto do acabamento',
      isPending: true,
      beginDate: new Date(now + 1000 * 60 * 60 * 24 * 40),
      endDate: new Date(now + 1000 * 60 * 60 * 24 * 45),
    },
  });
  o2.client = client2;
  o2.order = order2;
  o2.sourceEvent = o1;
  o2.employees = [employee2];

  const o3 = await helpers.createEvent({
    body: {
      client: client3._id,
      order: order3._id,
      sourceEvent: undefined,
      employees: [employee3._id],
      title: 'Medição do móvel',
      isPending: false,
      beginDate: new Date(now + 1000 * 60 * 60 * 24 * 50),
      endDate: new Date(now + 1000 * 60 * 60 * 24 * 55),
    },
  });
  o3.client = client3;
  o3.order = order3;
  o3.employees = [employee3];

  const objects = [o1, o2, o3];

  return { objects };
};

const baseRequest = utils.baseGqlRequest(app, createQuery);

const checkResponse = (
  expected: EventDocument,
  received: EventDocument,
): void => {
  checkObjects.checkEvent(expected as Required<EventInterface>, received);
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

  test('404 Events empty list', () => {
    return baseRequest({}, setupData.dev.token).then(
      utils.expectGqlError(err.EVENTS_EMPTY_LIST, resolver),
    );
  });

  let ents: Ents;
  test('200 Events found', async () => {
    ents = await createEnts();
    return baseRequest({}, setupData.dev.token).then(response => {
      // utils.printForDocs(response)
      baseResponseExpected(response);
    });
  });

  const sortTests = [
    {
      sort: 'beginDate',
      func: (a: any, b: any): number =>
        utils.sortByDateAsc(a.beginDate, b.beginDate),
    },
    {
      sort: '-beginDate',
      func: (a: any, b: any): number =>
        utils.sortByDateDesc(a.beginDate, b.beginDate),
    },
  ];
  const defaultSort = sortTests[0];
  sortTests.forEach(t => {
    test(`200 Events found - test sort by ${t.sort}`, () => {
      const sorted = ents.objects.sort(t.func);
      return baseRequest({ sort: t.sort }, setupData.dev.token).then(
        response => {
          baseResponseExpected(response);
          const { events } = response.body.data[resolver] as ListEventsResponse;
          events.forEach((obj, i) => {
            checkResponse(sorted[i], obj);
          });
        },
      );
    });
  });

  test('200 Events found - test paginate', () => {
    const sorted = ents.objects.sort(defaultSort.func);
    return baseRequest({ page: 1, perPage: 2 }, setupData.dev.token).then(
      response => {
        baseResponseExpected(response, 3, 2);
        const { events } = response.body.data[resolver] as ListEventsResponse;
        events.forEach((obj, i) => {
          checkResponse(sorted[i + 2], obj);
        });
      },
    );
  });

  const searchTests = [
    { field: 'title', q: 'montagem' },
    { field: 'title', q: 'conserto' },
    { field: 'title', q: 'medi' },
  ];
  searchTests.forEach(({ field, q }) => {
    test(`200 Events found - search by ${field} with q=${q}`, () => {
      const rest = createSearchRest(q);

      const expected = ents.objects
        .filter((o: any) => o[field].search(new RegExp(q, 'gi')) !== -1)
        .sort(defaultSort.func);

      return baseRequest({ rest }, setupData.dev.token).then(response => {
        baseResponseExpected(response, expected.length, 1);
        const { events } = response.body.data[resolver] as ListEventsResponse;
        events.forEach((obj, i) => {
          checkResponse(expected[i], obj);
        });
      });
    });
  });

  const filterTests = [
    ...createFilterTests(
      'dateInterval',
      createDateIntervalRest,
      (value: any) => (o: any): boolean =>
        o.beginDate >= value.beginDate && o.beginDate <= value.endDate,
      [
        {
          beginDate: new Date(Date.now() + 1000 * 60 * 60 * 24 * 30),
          endDate: new Date(Date.now() + 1000 * 60 * 60 * 24 * 35),
        },
        {
          beginDate: new Date(Date.now() + 1000 * 60 * 60 * 24 * 40),
          endDate: new Date(Date.now() + 1000 * 60 * 60 * 24 * 45),
        },
        {
          beginDate: new Date(Date.now() + 1000 * 60 * 60 * 24 * 50),
          endDate: new Date(Date.now() + 1000 * 60 * 60 * 24 * 55),
        },
      ],
    ),
    ...createFilterTests(
      'isPending',
      createIsPendingRest,
      (value: any) => (o: any): boolean => o.isPending === value,
      [true, false],
    ),
    ...createFilterTests(
      'order',
      createOrderRest,
      (value: any) => (o: any): boolean => isIDEqual(o.order._id, value),
      [0, 1, 2],
    ),
    ...createFilterTests(
      'client',
      createClientRest,
      (value: any) => (o: any): boolean => isIDEqual(o.client._id, value),
      [0, 1, 2],
    ),
    ...createFilterTests(
      'employee',
      createEmployeeRest,
      (value: any) => (o: any): boolean =>
        o.employees.some((employee: any) => isIDEqual(employee._id, value)),
      [0, 1, 2],
    ),
  ];
  filterTests.forEach(({ field, value, createRest, filterFunc }) => {
    test(`200 Events found - filter by ${field} ${value}`, () => {
      const isIdFilter = typeof value === 'number';

      // eslint-disable-next-line no-nested-ternary
      const newValue = isIdFilter
        ? field === 'employee'
          ? ents.objects[value as number].get('employees')[0]._id.toString()
          : ents.objects[value as number].get(field)._id.toString()
        : value;

      const rest = createRest(newValue);

      const expected = ents.objects
        .filter(filterFunc(newValue))
        .sort(defaultSort.func);

      return baseRequest({ rest }, setupData.admin.token).then(response => {
        // utils.printForDocs(response);
        baseResponseExpected(response, expected.length, 1);
        const { events } = response.body.data[resolver] as ListEventsResponse;
        events.forEach((obj, i) => {
          checkResponse(expected[i], obj);
        });
      });
    });
  });

  afterAll(async () => {
    await helpers.dropCollections([
      'Event',
      'User',
      'Order',
      'Client',
      'Employee',
    ]);
  });
};
