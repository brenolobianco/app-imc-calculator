/* eslint-disable max-lines-per-function */
import { Types } from 'mongoose';

import app from '../../app';
import * as utils from '../utils';
import * as helpers from '../helpers';
import Factory from '../../factories';
import * as err from '../../middlewares/errorHandling/errors';
import { Role } from '../../enums';
import { ProductDocument, ProductInterface } from '../../interfaces';
import * as gqlFieldsQuery from '../gqlFieldsQuery';
import * as checkObjects from '../checkObjects';
import { UpdateProductInput } from '../../types';
import * as gqlInputs from '../gqlInputs';

const resolver = 'updateProduct';

const fakeId = Types.ObjectId().toHexString();

let setupData: helpers.SetupTaskResult;

const createInput = gqlInputs.createInputUpdateProduct;

const createQuery = ({
  id,
  input,
}: {
  id: string;
  input: Required<UpdateProductInput>;
}): string => `
mutation {
  ${resolver}(id: "${id}", input: ${createInput(input)}) {
    product ${gqlFieldsQuery.productFieldsQuery}
    error ${gqlFieldsQuery.errorFieldsQuery}
  }
}`;

const baseRequest = utils.baseGqlRequest(app, createQuery);

const checkResponse = (
  expected: ProductDocument,
  received: ProductDocument,
): void => {
  checkObjects.checkProduct(expected as Required<ProductInterface>, received);
  expect(received).toMatchObject({
    _id: expected._id.toString(),
  });
};

const createFakeBody = (
  body: Partial<UpdateProductInput> = {},
): Required<UpdateProductInput> =>
  Factory.build<Required<UpdateProductInput>>('Product', body);

type Ents = { objects: ProductDocument[] };
const createEnts = async (): Promise<Ents> => {
  const o1 = await helpers.createProduct({});

  const o2 = await helpers.createProduct({});

  const objects = [o1, o2];

  return { objects };
};

// eslint-disable-next-line max-lines-per-function
export default (): void => {
  beforeAll(async () => {
    setupData = await helpers.setupTask();
  });

  const fakeBody = createFakeBody();
  utils.testIsGqlAuthenticated(
    app,
    resolver,
    createQuery({ id: fakeId, input: fakeBody }),
  );

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

  test('404 Product not found - no product', async () => {
    const body = createFakeBody();

    return baseRequest({ id: fakeId, input: body }, setupData.dev.token).then(
      utils.expectGqlError(err.PRODUCT_NOT_FOUND, resolver),
    );
  });

  let ents: Ents;
  test('404 Product not found - wrong id', async () => {
    ents = await createEnts();
    const body = createFakeBody();
    return baseRequest({ id: fakeId, input: body }, setupData.dev.token).then(
      utils.expectGqlError(err.PRODUCT_NOT_FOUND, resolver),
    );
  });

  test('404 Finish not found', async () => {
    const object = ents.objects[0];
    const id = object._id.toString();

    const body = createFakeBody();

    return baseRequest({ id, input: body }, setupData.dev.token).then(
      utils.expectGqlError(err.FINISH_NOT_FOUND, resolver),
    );
  });

  test('200 Product updated', async () => {
    const object = ents.objects[0];
    const id = object._id.toString();

    const finish = await helpers.createFinish({});

    const body = createFakeBody({
      pricesPerFinishes: [{ price: 36700, finish: finish._id }],
    });

    return baseRequest({ id, input: body }, setupData.dev.token).then(
      response => {
        // utils.printForDocs(response.body);
        const { product, error } = response.body.data[resolver];
        expect(error).toBe(null);

        const expected = {
          ...object.toJSON(),
          ...body,
          pricesPerFinishes: [{ price: 36700, finish }],
        };

        checkResponse(expected, product);
      },
    );
  });

  afterAll(async () => {
    await helpers.dropCollections(['User', 'Product', 'Finish']);
  });
};
