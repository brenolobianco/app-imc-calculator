/* eslint-disable max-lines-per-function */
import app from '../../app';
import * as utils from '../utils';
import * as helpers from '../helpers';
import Factory from '../../factories';
import * as err from '../../middlewares/errorHandling/errors';
import { Role } from '../../enums';
import { ProductInterface } from '../../interfaces';
import * as gqlFieldsQuery from '../gqlFieldsQuery';
import * as checkObjects from '../checkObjects';
import * as gqlInputs from '../gqlInputs';
import { CreateProductInput } from '../../types';

const resolver = 'createProduct';

let setupData: helpers.SetupTaskResult;

const createInput = gqlInputs.createInputCreateProduct;

const createQuery = ({ input }: { input: CreateProductInput }): string => `
mutation {
  ${resolver}(input: ${createInput(input)}) {
    product ${gqlFieldsQuery.productFieldsQuery}
    error ${gqlFieldsQuery.errorFieldsQuery}
  }
}`;

const baseRequest = utils.baseGqlRequest(app, createQuery);

const checkResponse = checkObjects.checkProduct;

const createFakeBody = (
  body: Partial<CreateProductInput> = {},
): Required<CreateProductInput> =>
  Factory.build<Required<CreateProductInput>>('Product', body);

// eslint-disable-next-line max-lines-per-function
export default (): void => {
  beforeAll(async () => {
    setupData = await helpers.setupTask();
  });

  const fakeBody = createFakeBody();
  utils.testIsGqlAuthenticated(app, resolver, createQuery({ input: fakeBody }));

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

  test('404 Finish not found', async () => {
    const body = createFakeBody();

    return baseRequest({ input: body }, setupData.dev.token).then(
      utils.expectGqlError(err.FINISH_NOT_FOUND, resolver),
    );
  });

  test('200 Product created', async () => {
    const finish = await helpers.createFinish({});

    const body = createFakeBody({
      pricesPerFinishes: [{ price: 36700, finish: finish._id }],
    });

    return baseRequest({ input: body }, setupData.dev.token).then(response => {
      const { product, error } = response.body.data[resolver];
      expect(error).toBe(null);

      const expected = {
        ...body,
        pricesPerFinishes: [{ price: 36700, finish }],
      };

      checkResponse(expected, product);
    });
  });

  afterAll(async () => {
    await helpers.dropCollections(['User', 'Product', 'Finish']);
  });
};
