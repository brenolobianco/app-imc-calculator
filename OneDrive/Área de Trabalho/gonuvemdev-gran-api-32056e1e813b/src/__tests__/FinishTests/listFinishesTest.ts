/* eslint-disable max-lines */
/* eslint-disable max-lines-per-function */
import app from '../../app';
import * as utils from '../utils';
import * as helpers from '../helpers';
import * as err from '../../middlewares/errorHandling/errors';
import { Role } from '../../enums';
import * as gqlFieldsQuery from '../gqlFieldsQuery';
import * as checkObjects from '../checkObjects';
import { FinishDocument, FinishInterface } from '../../interfaces';
import { ListFinishesResponse } from '../../types';
import { createArgumentRest } from '../gqlTestHelper';

const resolver = 'listFinishes';

let setupData: helpers.SetupTaskResult;

const createSearchRest = createArgumentRest('q');

const createQuery = ({
  page = 0,
  perPage = 5,
  sort = 'code',
  rest = '',
}): string => `
query {
  ${resolver}(page: ${page}, perPage: ${perPage}, sort: "${sort}"${rest}) {
    finishes ${gqlFieldsQuery.finishFieldsQuery}
    total
    pages
    error ${gqlFieldsQuery.errorFieldsQuery}
  }
}
`;

const baseResponseExpected = utils.baseGqlListResponseExpected(
  'finishes',
  resolver,
);

type Ents = { objects: FinishDocument[] };
const createEnts = async (): Promise<Ents> => {
  const o1 = await helpers.createFinish({ body: { code: 'G-01-2' } });

  const o2 = await helpers.createFinish({ body: { code: 'NICHO' } });

  const o3 = await helpers.createFinish({ body: { code: 'LAREIRA' } });

  const objects = [o1, o2, o3];

  return { objects };
};

const baseRequest = utils.baseGqlRequest(app, createQuery);

const checkResponse = (
  expected: FinishDocument,
  received: FinishDocument,
): void => {
  checkObjects.checkFinish(expected as Required<FinishInterface>, received);
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

  test('404 Finishes empty list', () => {
    return baseRequest({}, setupData.dev.token).then(
      utils.expectGqlError(err.FINISHES_EMPTY_LIST, resolver),
    );
  });

  let ents: Ents;
  test('200 Finishes found', async () => {
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
      sort: '-code',
      func: (a: any, b: any): number => utils.sortByStringDesc(a.code, b.code),
    },
    {
      sort: 'code',
      func: (a: any, b: any): number => utils.sortByStringAsc(a.code, b.code),
    },
  ];
  const defaultSort = sortTests[3];
  sortTests.forEach(t => {
    test(`200 Finishes found - test sort by ${t.sort}`, () => {
      const sorted = ents.objects.sort(t.func);
      return baseRequest({ sort: t.sort }, setupData.dev.token).then(
        response => {
          baseResponseExpected(response);
          const { finishes } = response.body.data[
            resolver
          ] as ListFinishesResponse;
          finishes.forEach((obj, i) => {
            checkResponse(sorted[i], obj);
          });
        },
      );
    });
  });

  test('200 Finishes found - test paginate', () => {
    const sorted = ents.objects.sort(defaultSort.func);
    return baseRequest({ page: 1, perPage: 2 }, setupData.dev.token).then(
      response => {
        baseResponseExpected(response, 3, 2);
        const { finishes } = response.body.data[
          resolver
        ] as ListFinishesResponse;
        finishes.forEach((obj, i) => {
          checkResponse(sorted[i + 2], obj);
        });
      },
    );
  });

  const searchTests = [
    { field: 'code', q: 'g-01' },
    { field: 'code', q: 'nich' },
    { field: 'code', q: 'larei' },
  ];
  searchTests.forEach(({ field, q }) => {
    test(`200 Finishes found - search by ${field} with q=${q}`, () => {
      const rest = createSearchRest(q);

      const expected = ents.objects
        .filter((o: any) => o[field].search(new RegExp(q, 'gi')) !== -1)
        .sort(defaultSort.func);

      return baseRequest({ rest }, setupData.dev.token).then(response => {
        baseResponseExpected(response, expected.length, 1);
        const { finishes } = response.body.data[
          resolver
        ] as ListFinishesResponse;
        finishes.forEach((obj, i) => {
          checkResponse(expected[i], obj);
        });
      });
    });
  });

  afterAll(async () => {
    await helpers.dropCollections(['Finish', 'User']);
  });
};
