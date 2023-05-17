/* eslint-disable max-lines */
/* eslint-disable max-lines-per-function */
import app from '../../app';
import * as utils from '../utils';
import * as helpers from '../helpers';
import * as err from '../../middlewares/errorHandling/errors';
import { Role } from '../../enums';
import * as gqlFieldsQuery from '../gqlFieldsQuery';
import * as checkObjects from '../checkObjects';
import { AdminDoc, ClientDocument, ClientInterface } from '../../interfaces';
import { ListClientsResponse } from '../../types';
import {
  createArgumentRest,
  createFilterTests,
  createStringValue,
} from '../gqlTestHelper';
import { isIDEqual } from '../../utils/general';

const resolver = 'listClients';

let setupData: helpers.SetupTaskResult;

/** Search */
const createSearchRest = createArgumentRest('q');

/** Filters */
const createTypeRest = createArgumentRest('type', createStringValue);
const createAdminWhoRegisteredRest = createArgumentRest(
  'adminWhoRegistered',
  createStringValue,
);

const createQuery = ({
  page = 0,
  perPage = 5,
  sort = 'name',
  rest = '',
}): string => `
query {
  ${resolver}(page: ${page}, perPage: ${perPage}, sort: "${sort}"${rest}) {
    clients ${gqlFieldsQuery.clientFieldsQuery}
    total
    pages
    error ${gqlFieldsQuery.errorFieldsQuery}
  }
}
`;

const baseResponseExpected = utils.baseGqlListResponseExpected(
  'clients',
  resolver,
);

type Ents = { objects: ClientDocument[] };
const createEnts = async (): Promise<Ents> => {
  const [a1, a2, a3] = await Promise.all([
    helpers.createAdmin({}),
    helpers.createAdmin({}),
    helpers.createAdmin({}),
  ]);

  const o1 = await helpers.createClient({
    body: {
      name: 'Maria Carvalho',
      primaryPhone: '8600111112222',
      secondaryPhones: ['8900111112222'],
      type: 'PF',
      adminWhoRegistered: a1._id,
    },
  });
  o1.adminWhoRegistered = a1;

  const o2 = await helpers.createClient({
    body: {
      name: 'Armazém Paraíba',
      primaryPhone: '7600111112222',
      secondaryPhones: ['7900111112222'],
      type: 'PJ',
      adminWhoRegistered: a2._id,
    },
  });
  o2.adminWhoRegistered = a2;

  const o3 = await helpers.createClient({
    body: {
      name: 'Lucas Esteves',
      primaryPhone: '9600111112222',
      secondaryPhones: ['9900111112222'],
      type: 'PF',
      adminWhoRegistered: a3._id,
    },
  });
  o3.adminWhoRegistered = a3;

  const objects = [o1, o2, o3];

  return { objects };
};

const baseRequest = utils.baseGqlRequest(app, createQuery);

const checkResponse = (
  expected: ClientDocument,
  received: ClientDocument,
): void => {
  checkObjects.checkClient(expected as Required<ClientInterface>, received);
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

  test('404 Clients empty list', () => {
    return baseRequest({}, setupData.dev.token).then(
      utils.expectGqlError(err.CLIENTS_EMPTY_LIST, resolver),
    );
  });

  let ents: Ents;
  test('200 Clients found', async () => {
    ents = await createEnts();
    return baseRequest({}, setupData.dev.token).then(response => {
      // utils.printForDocs(response)
      baseResponseExpected(response);
    });
  });

  const sortTests = [
    {
      sort: 'name',
      func: (a: any, b: any): number => utils.sortByStringAsc(a.name, b.name),
    },
    {
      sort: '-name',
      func: (a: any, b: any): number => utils.sortByStringDesc(a.name, b.name),
    },
    {
      sort: 'createdAt',
      func: (a: any, b: any): number =>
        utils.sortByDateAsc(a.createdAt, b.createdAt),
    },
    {
      sort: '-createdAt',
      func: (a: any, b: any): number =>
        utils.sortByDateDesc(a.createdAt, b.createdAt),
    },
  ];
  const defaultSort = sortTests[3];
  sortTests.forEach(t => {
    test(`200 Clients found - test sort by ${t.sort}`, () => {
      const sorted = ents.objects.sort(t.func);
      return baseRequest({ sort: t.sort }, setupData.dev.token).then(
        response => {
          baseResponseExpected(response);
          const { clients } = response.body.data[
            resolver
          ] as ListClientsResponse;
          clients.forEach((obj, i) => {
            checkResponse(sorted[i], obj);
          });
        },
      );
    });
  });

  test('200 Clients found - test paginate', () => {
    const sorted = ents.objects.sort(defaultSort.func);
    return baseRequest({ page: 1, perPage: 2 }, setupData.dev.token).then(
      response => {
        baseResponseExpected(response, 3, 2);
        const { clients } = response.body.data[resolver] as ListClientsResponse;
        clients.forEach((obj, i) => {
          checkResponse(sorted[i + 2], obj);
        });
      },
    );
  });

  const searchTests = [
    { field: 'name', q: 'Maria' },
    { field: 'name', q: 'Paraíba' },
    { field: 'name', q: 'Lucas' },
    { field: 'primaryPhone', q: '76' },
    { field: 'primaryPhone', q: '86' },
    { field: 'primaryPhone', q: '96' },
    { field: 'secondaryPhones', q: '79' },
    { field: 'secondaryPhones', q: '89' },
    { field: 'secondaryPhones', q: '99' },
  ];
  searchTests.forEach(({ field, q }) => {
    test(`200 Clients found - search by ${field} with q=${q}`, () => {
      const rest = createSearchRest(q);

      const expected =
        field === 'secondaryPhones'
          ? ents.objects.filter((o: any) =>
            o[field].some(
              (phone: string) => phone.search(new RegExp(q, 'gi')) !== -1,
            ),
          )
          : ents.objects
            .filter((o: any) => o[field].search(new RegExp(q, 'gi')) !== -1)
            .sort(defaultSort.func);

      return baseRequest({ rest }, setupData.dev.token).then(response => {
        baseResponseExpected(response, expected.length, 1);
        const { clients } = response.body.data[resolver] as ListClientsResponse;
        clients.forEach((obj, i) => {
          checkResponse(expected[i], obj);
        });
      });
    });
  });

  const filterTests = [
    ...createFilterTests(
      'type',
      createTypeRest,
      (value: any) => (o: any): boolean => o.type === value,
      ['PF', 'PJ'],
    ),
  ];
  filterTests.forEach(({ field, value, createRest, filterFunc }) => {
    test(`200 Clients found - filter by ${field} ${value}`, () => {
      const rest = createRest(value);

      const expected = ents.objects
        .filter(filterFunc(value))
        .sort(defaultSort.func);

      return baseRequest({ rest }, setupData.admin.token).then(response => {
        // utils.printForDocs(response)
        baseResponseExpected(response, expected.length, 1);
        const { clients } = response.body.data[resolver] as ListClientsResponse;
        clients.forEach((obj, i) => {
          checkResponse(expected[i], obj);
        });
      });
    });
  });

  Array.from({ length: 3 }).forEach((_, i) => {
    test(`200 Clients found - filter by adminWhoRegistered #${i + 1}`, () => {
      const adminWhoRegistered = ents.objects[i].adminWhoRegistered as AdminDoc;

      const id = adminWhoRegistered._id;

      const rest = createAdminWhoRegisteredRest(id);

      const expected = [ents.objects[i]];

      return baseRequest({ rest }, setupData.admin.token).then(response => {
        // utils.printForDocs(response);
        baseResponseExpected(response, expected.length, 1);
        const { clients } = response.body.data[resolver];
        clients.forEach((obj: any, j: number) => {
          checkResponse(expected[j], obj);
        });
      });
    });
  });

  afterAll(async () => {
    await helpers.dropCollections(['Client', 'User', 'Admin']);
  });
};
