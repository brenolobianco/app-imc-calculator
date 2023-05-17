/* eslint-disable max-lines-per-function */
import app from '../../app';
import * as utils from '../utils';
import * as helpers from '../helpers';
import Factory from '../../factories';
import * as err from '../../middlewares/errorHandling/errors';
import { Role } from '../../enums';
import { FinishInterface } from '../../interfaces';
import * as gqlFieldsQuery from '../gqlFieldsQuery';
import * as checkObjects from '../checkObjects';
import * as gqlInputs from '../gqlInputs';
import { CreateFinishInput } from '../../types';
import Product from '../../models/Product';

const resolver = 'createFinish';

let setupData: helpers.SetupTaskResult;

const createInput = gqlInputs.createInputCreateFinish;

const createQuery = ({ input }: { input: CreateFinishInput }): string => `
mutation {
  ${resolver}(input: ${createInput(input)}) {
    finish ${gqlFieldsQuery.finishFieldsQuery}
    error ${gqlFieldsQuery.errorFieldsQuery}
  }
}`;

const baseRequest = utils.baseGqlRequest(app, createQuery);

const checkResponse = checkObjects.checkFinish;

const createFakeBody = (
  body: Partial<FinishInterface> = {},
): Required<FinishInterface> => Factory.build('Finish', body);

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

  test('409 Finish code conflict', async () => {
    const finish = await helpers.createFinish({});

    const body = createFakeBody({ code: finish.code });

    return baseRequest({ input: body }, setupData.dev.token).then(
      utils.expectGqlError(err.FINISH_CODE_CONFLICT, resolver),
    );
  });

  test('200 Finish created', async () => {
    const body = createFakeBody({ value: 100 });
    const [product1, product2] = await Promise.all([
      helpers.createProduct({ body: { cost: 10000, pricesPerFinishes: [] } }),
      helpers.createProduct({ body: { cost: 30000, pricesPerFinishes: [] } }),
    ]);

    return baseRequest({ input: body }, setupData.dev.token).then(
      async response => {
        // utils.printForDocs(response);
        const { finish, error } = response.body.data[resolver];
        expect(error).toBe(null);

        checkResponse(body, finish);
        const [updatedProduct1, updatedProduct2] = await Promise.all([
          Product.findById(product1._id),
          Product.findById(product2._id),
        ]);
        expect(updatedProduct1?.pricesPerFinishes).toHaveLength(1);
        expect(updatedProduct1?.pricesPerFinishes?.[0].price).toBe(10500);
        expect(updatedProduct1?.pricesPerFinishes?.[0].finish.toString()).toBe(
          finish._id.toString(),
        );
        expect(updatedProduct2?.pricesPerFinishes).toHaveLength(1);
        expect(updatedProduct2?.pricesPerFinishes?.[0].price).toBe(22050);
        expect(updatedProduct2?.pricesPerFinishes?.[0].finish.toString()).toBe(
          finish._id.toString(),
        );
      },
    );
  });

  afterAll(async () => {
    await helpers.dropCollections(['User', 'Finish', 'Product']);
  });
};
