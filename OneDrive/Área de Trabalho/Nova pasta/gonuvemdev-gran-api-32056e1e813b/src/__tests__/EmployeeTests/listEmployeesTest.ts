/* eslint-disable max-lines */
/* eslint-disable max-lines-per-function */
import app from '../../app';
import * as utils from '../utils';
import * as helpers from '../helpers';
import * as err from '../../middlewares/errorHandling/errors';
import { Role } from '../../enums';
import * as gqlFieldsQuery from '../gqlFieldsQuery';
import * as checkObjects from '../checkObjects';
import { EmployeeDocument, EmployeeInterface } from '../../interfaces';
import { ListEmployeesResponse } from '../../types';
import { createArgumentRest, createFilterTests } from '../gqlTestHelper';

const resolver = 'listEmployees';

let setupData: helpers.SetupTaskResult;

const createSearchRest = createArgumentRest('q');
const createOccupationRest = createArgumentRest('occupation');

const createQuery = ({
  page = 0,
  perPage = 5,
  sort = 'name',
  rest = '',
}): string => `
query {
  ${resolver}(page: ${page}, perPage: ${perPage}, sort: "${sort}"${rest}) {
    employees ${gqlFieldsQuery.employeeFieldsQuery}
    total
    pages
    error ${gqlFieldsQuery.errorFieldsQuery}
  }
}
`;

const baseResponseExpected = utils.baseGqlListResponseExpected(
  'employees',
  resolver,
);

type Ents = { objects: EmployeeDocument[] };
const createEnts = async (): Promise<Ents> => {
  const o1 = await helpers.createEmployee({
    body: {
      name: 'Valdecir Lopis',
      occupation: 'Diretor',
      cpf: '000.111.222-33',
    },
  });

  const o2 = await helpers.createEmployee({
    body: {
      name: 'Danny Picket',
      occupation: 'Operário',
      cpf: '333.444.555-66',
    },
  });

  const o3 = await helpers.createEmployee({
    body: {
      name: 'Richard Alpert',
      occupation: 'Vendedor(a)',
      cpf: '666.777.888-99',
    },
  });

  const objects = [o1, o2, o3];

  return { objects };
};

const baseRequest = utils.baseGqlRequest(app, createQuery);

const checkResponse = (
  expected: EmployeeDocument,
  received: EmployeeDocument,
): void => {
  checkObjects.checkEmployee(expected as Required<EmployeeInterface>, received);
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

  test('404 Employees empty list', () => {
    return baseRequest({}, setupData.dev.token).then(
      utils.expectGqlError(err.EMPLOYEES_EMPTY_LIST, resolver),
    );
  });

  let ents: Ents;
  test('200 Employees found', async () => {
    ents = await createEnts();
    return baseRequest({}, setupData.dev.token).then(response => {
      // utils.printForDocs(response)
      baseResponseExpected(response);
    });
  });

  const sortTests = [
    {
      sort: '-createdAt',
      func: (a: any, b: any): number =>
        utils.sortByDateDesc(a.createdAt, b.createdAt),
    },
    {
      sort: 'createdAt',
      func: (a: any, b: any): number =>
        utils.sortByDateAsc(a.createdAt, b.createdAt),
    },
    {
      sort: '-name',
      func: (a: any, b: any): number => utils.sortByStringDesc(a.name, b.name),
    },
    {
      sort: 'name',
      func: (a: any, b: any): number => utils.sortByStringAsc(a.name, b.name),
    },
  ];
  const defaultSort = sortTests[3];
  sortTests.forEach(t => {
    test(`200 Employees found - test sort by ${t.sort}`, () => {
      const sorted = ents.objects.sort(t.func);
      return baseRequest({ sort: t.sort }, setupData.dev.token).then(
        response => {
          baseResponseExpected(response);
          const { employees } = response.body.data[
            resolver
          ] as ListEmployeesResponse;
          employees.forEach((obj, i) => {
            checkResponse(sorted[i], obj);
          });
        },
      );
    });
  });

  test('200 Employees found - test paginate', () => {
    const sorted = ents.objects.sort(defaultSort.func);
    return baseRequest({ page: 1, perPage: 2 }, setupData.dev.token).then(
      response => {
        baseResponseExpected(response, 3, 2);
        const { employees } = response.body.data[
          resolver
        ] as ListEmployeesResponse;
        employees.forEach((obj, i) => {
          checkResponse(sorted[i + 2], obj);
        });
      },
    );
  });

  const searchTests = [
    { field: 'name', q: 'Alpert' },
    { field: 'name', q: 'Valdecir' },
    { field: 'name', q: 'Danny' },
    { field: 'cpf', q: '000' },
    { field: 'cpf', q: '333' },
    { field: 'cpf', q: '666' },
  ];
  searchTests.forEach(({ field, q }) => {
    test(`200 Employees found - search by ${field} with q=${q}`, () => {
      const rest = createSearchRest(q);

      const expected = ents.objects
        .filter((o: any) => o[field].search(q) !== -1)
        .sort(defaultSort.func);

      return baseRequest({ rest }, setupData.dev.token).then(response => {
        baseResponseExpected(response, expected.length, 1);
        const { employees } = response.body.data[
          resolver
        ] as ListEmployeesResponse;
        employees.forEach((obj, i) => {
          checkResponse(expected[i], obj);
        });
      });
    });
  });

  const filterTests = [
    ...createFilterTests(
      'occupation',
      createOccupationRest,
      (value: any) => (o: any): boolean => o.occupation === value,
      ['Vendedor(a)', 'Diretor', 'Operário'],
    ),
  ];
  filterTests.forEach(({ field, value, createRest, filterFunc }) => {
    test(`200 Employees found - filter by ${field} ${value}`, () => {
      const rest = createRest(value);

      const expected = ents.objects
        .filter(filterFunc(value))
        .sort(defaultSort.func);

      return baseRequest({ rest }, setupData.admin.token).then(response => {
        // utils.printForDocs(response)
        baseResponseExpected(response, expected.length, 1);
        const { employees } = response.body.data[
          resolver
        ] as ListEmployeesResponse;
        employees.forEach((obj, i) => {
          checkResponse(expected[i], obj);
        });
      });
    });
  });

  afterAll(async () => {
    await helpers.dropCollections(['Employee', 'User']);
  });
};
