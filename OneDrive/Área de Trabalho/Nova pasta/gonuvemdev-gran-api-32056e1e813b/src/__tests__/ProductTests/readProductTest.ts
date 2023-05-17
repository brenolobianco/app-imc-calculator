/* eslint-disable max-lines-per-function */
import { Types } from 'mongoose';

import app from '../../app';
import * as utils from '../utils';
import * as helpers from '../helpers';
import * as err from '../../middlewares/errorHandling/errors';
import { Role } from '../../enums';
import * as gqlFieldsQuery from '../gqlFieldsQuery';
import * as checkObjects from '../checkObjects';
import { ProductDocument, ProductInterface } from '../../interfaces';

const resolver = 'readProduct';

const fakeId = Types.ObjectId().toHexString();

let setupData: helpers.SetupTaskResult;

const createQuery = ({ id }: { id: string }): string => `
query {
  ${resolver}(id: "${id}") {
    product ${gqlFieldsQuery.productFieldsQuery}
    error ${gqlFieldsQuery.errorFieldsQuery}
  }
}
`;

type Ents = { objects: ProductDocument[] };
const createEnts = async (): Promise<Ents> => {
  const o1 = await helpers.createProduct({
    body: { name: 'CUBA BAHIA', pricesPerFinishes: undefined },
  });

  const o2 = await helpers.createProduct({
    body: { name: 'MÁRMORE BRANCO', pricesPerFinishes: undefined },
  });

  const o3 = await helpers.createProduct({
    body: { name: 'LIXEIRA HIDRONOX', pricesPerFinishes: undefined },
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

  utils.testIsGqlAuthenticated(app, resolver, createQuery({ id: fakeId }));

  const { rolesAllowed, rolesNotAllowed } = helpers.splitRolesByPermission([
    Role.Dev,
    Role.Admin,
  ]);

  rolesNotAllowed.forEach(role => {
    test(`403 ${role} not allowed`, () => {
      return baseRequest({ id: fakeId }, setupData[role].token).then(
        utils.expectGqlError(err.USER_NOT_ALLOWED, resolver),
      );
    });
  });

  rolesAllowed.forEach(role => {
    test(`Not 403 - ${role} allowed`, () => {
      return baseRequest({ id: fakeId }, setupData[role].token).then(
        response => {
          expect(response.status).not.toBe(403);
        },
      );
    });
  });

  test('404 Product not found - no product', () => {
    return baseRequest({ id: fakeId }, setupData.dev.token).then(
      utils.expectGqlError(err.PRODUCT_NOT_FOUND, resolver),
    );
  });

  let ents: Ents;
  test('404 Product not found - wrong id', async () => {
    ents = await createEnts();

    return baseRequest({ id: fakeId }, setupData.dev.token).then(
      utils.expectGqlError(err.PRODUCT_NOT_FOUND, resolver),
    );
  });

  Array.from({ length: 3 }, (v, k) => k).forEach(i => {
    test(`200 Product found - product #${i + 1}`, () => {
      const expected = ents.objects[i];
      return baseRequest(
        { id: expected._id.toString() },
        setupData.dev.token,
      ).then(response => {
        // utils.printForDocs(response);
        const { product, error } = response.body.data[resolver];
        expect(error).toBeNull();
        checkResponse(expected, product);
      });
    });
  });

  afterAll(async () => {
    await helpers.dropCollections(['Product', 'User']);
  });
};
