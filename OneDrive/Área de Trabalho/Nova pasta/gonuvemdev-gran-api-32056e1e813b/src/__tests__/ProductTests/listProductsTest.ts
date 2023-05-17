/* eslint-disable max-lines */
/* eslint-disable max-lines-per-function */
import app from '../../app';
import * as utils from '../utils';
import * as helpers from '../helpers';
import * as err from '../../middlewares/errorHandling/errors';
import { Role } from '../../enums';
import * as gqlFieldsQuery from '../gqlFieldsQuery';
import * as checkObjects from '../checkObjects';
import { ProductDocument, ProductInterface } from '../../interfaces';
import { ListProductsResponse } from '../../types';
import {
  createArgumentRest,
  createFilterTests,
  createNonStringValue,
} from '../gqlTestHelper';
import { ProductType } from '../../enums/ProductType';

const resolver = 'listProducts';

let setupData: helpers.SetupTaskResult;

const createSearchRest = createArgumentRest('q');
const createIsActivatedRest = createArgumentRest(
  'isActivated',
  createNonStringValue,
);

const createTypeRest = createArgumentRest('type', createNonStringValue);

const createQuery = ({
  page = 0,
  perPage = 5,
  sort = 'name',
  rest = '',
}): string => `
query {
  ${resolver}(page: ${page}, perPage: ${perPage}, sort: "${sort}"${rest}) {
    products ${gqlFieldsQuery.productFieldsQuery}
    total
    pages
    error ${gqlFieldsQuery.errorFieldsQuery}
  }
}
`;

const baseResponseExpected = utils.baseGqlListResponseExpected(
  'products',
  resolver,
);

type Ents = { objects: ProductDocument[] };
const createEnts = async (): Promise<Ents> => {
  const o1 = await helpers.createProduct({
    body: {
      name: 'CUBA BAHIA',
      isActivated: true,
      type: ProductType.Accessories,
      pricesPerFinishes: undefined,
    },
  });

  const o2 = await helpers.createProduct({
    body: {
      name: 'MÁRMORE BRANCO',
      isActivated: false,
      type: ProductType.RawMaterial,
      pricesPerFinishes: undefined,
    },
  });

  const o3 = await helpers.createProduct({
    body: {
      name: 'LIXEIRA HIDRONOX',
      isActivated: true,
      type: ProductType.Others,
      pricesPerFinishes: undefined,
    },
  });

  const objects = [o1, o2, o3];

  return { objects };
};

const baseRequest = utils.baseGqlRequest(app, createQuery);

const checkResponse = (
  expected: ProductDocument,
  received: ProductDocument,
): void => {
  checkObjects.checkProduct(expected as Required<ProductInterface>, received);
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

  test('404 Products empty list', () => {
    return baseRequest({}, setupData.dev.token).then(
      utils.expectGqlError(err.PRODUCTS_EMPTY_LIST, resolver),
    );
  });

  let ents: Ents;
  test('200 Products found', async () => {
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
    {
      sort: '-cost',
      func: (a: any, b: any): number => utils.sortByNumberDesc(a.cost, b.cost),
    },
    {
      sort: 'cost',
      func: (a: any, b: any): number => utils.sortByNumberAsc(a.cost, b.cost),
    },
  ];
  const defaultSort = sortTests[3];
  sortTests.forEach(t => {
    test(`200 Products found - test sort by ${t.sort}`, () => {
      const sorted = ents.objects.sort(t.func);
      return baseRequest({ sort: t.sort }, setupData.dev.token).then(
        response => {
          baseResponseExpected(response);
          const { products } = response.body.data[
            resolver
          ] as ListProductsResponse;
          products.forEach((obj, i) => {
            checkResponse(sorted[i], obj);
          });
        },
      );
    });
  });

  test('200 Products found - test paginate', () => {
    const sorted = ents.objects.sort(defaultSort.func);
    return baseRequest({ page: 1, perPage: 2 }, setupData.dev.token).then(
      response => {
        baseResponseExpected(response, 3, 2);
        const { products } = response.body.data[
          resolver
        ] as ListProductsResponse;
        products.forEach((obj, i) => {
          checkResponse(sorted[i + 2], obj);
        });
      },
    );
  });

  const searchTests = [
    { field: 'name', q: 'branco' },
    { field: 'name', q: 'cuba' },
    { field: 'name', q: 'lixeira' },
  ];
  searchTests.forEach(({ field, q }) => {
    test(`200 Products found - search by ${field} with q=${q}`, () => {
      const rest = createSearchRest(q);

      const expected = ents.objects
        .filter((o: any) => o[field].search(new RegExp(q, 'gi')) !== -1)
        .sort(defaultSort.func);

      return baseRequest({ rest }, setupData.dev.token).then(response => {
        baseResponseExpected(response, expected.length, 1);
        const { products } = response.body.data[
          resolver
        ] as ListProductsResponse;
        products.forEach((obj, i) => {
          checkResponse(expected[i], obj);
        });
      });
    });
  });

  const filterTests = [
    ...createFilterTests(
      'isActivated',
      createIsActivatedRest,
      (value: any) => (o: any): boolean => o.isActivated === value,
      [true, false],
    ),
    ...createFilterTests(
      'type',
      createTypeRest,
      (value: any) => (o: any): boolean => o.type === value,
      [ProductType.Accessories, ProductType.RawMaterial],
    ),
  ];
  filterTests.forEach(({ field, value, createRest, filterFunc }) => {
    test(`200 Products found - filter by ${field} ${value}`, () => {
      const rest = createRest(value);

      const expected = ents.objects
        .filter(filterFunc(value))
        .sort(defaultSort.func);

      return baseRequest({ rest }, setupData.admin.token).then(response => {
        // utils.printForDocs(response)
        baseResponseExpected(response, expected.length, 1);
        const { products } = response.body.data[
          resolver
        ] as ListProductsResponse;
        products.forEach((obj, i) => {
          checkResponse(expected[i], obj);
        });
      });
    });
  });

  afterAll(async () => {
    await helpers.dropCollections(['Product', 'User']);
  });
};
