/* eslint-disable max-lines-per-function */
import { Types } from 'mongoose';

import app from '../../app';
import * as utils from '../utils';
import * as helpers from '../helpers';
import Factory from '../../factories';
import * as err from '../../middlewares/errorHandling/errors';
import { Role } from '../../enums';
import { FinishDocument, FinishInterface, ProductDoc } from '../../interfaces';
import * as gqlFieldsQuery from '../gqlFieldsQuery';
import * as checkObjects from '../checkObjects';
import { UpdateFinishInput } from '../../types';
import * as gqlInputs from '../gqlInputs';
import Product from '../../models/Product';

const resolver = 'updateFinish';

const fakeId = Types.ObjectId().toHexString();

let setupData: helpers.SetupTaskResult;

const createInput = gqlInputs.createInputUpdateFinish;

const createQuery = ({
  id,
  input,
}: {
  id: string;
  input: Required<UpdateFinishInput>;
}): string => `
mutation {
  ${resolver}(id: "${id}", input: ${createInput(input)}) {
    finish ${gqlFieldsQuery.finishFieldsQuery}
    error ${gqlFieldsQuery.errorFieldsQuery}
  }
}`;

const baseRequest = utils.baseGqlRequest(app, createQuery);

const checkResponse = (
  expected: FinishDocument,
  received: FinishDocument,
): void => {
  checkObjects.checkFinish(expected as Required<FinishInterface>, received);
  expect(received).toMatchObject({
    _id: expected._id.toString(),
  });
};

const createFakeBody = (
  body: Partial<FinishInterface> = {},
): Required<FinishInterface> =>
  Factory.build<Required<FinishInterface>>('Finish', body);

type Ents = { objects: FinishDocument[] };
const createEnts = async (): Promise<Ents> => {
  const o1 = await helpers.createFinish({});

  const o2 = await helpers.createFinish({});

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

  test('404 Finish not found - no finish', async () => {
    const body = createFakeBody();

    return baseRequest({ id: fakeId, input: body }, setupData.dev.token).then(
      utils.expectGqlError(err.FINISH_NOT_FOUND, resolver),
    );
  });

  let ents: Ents;
  test('404 Finish not found - wrong id', async () => {
    ents = await createEnts();
    const body = createFakeBody();
    return baseRequest({ id: fakeId, input: body }, setupData.dev.token).then(
      utils.expectGqlError(err.FINISH_NOT_FOUND, resolver),
    );
  });

  test('409 Finish code conflict', async () => {
    const finish = await helpers.createFinish({});
    const object = ents.objects[0];
    const id = object._id.toString();
    const body = createFakeBody({ code: finish.code });

    return baseRequest({ id, input: body }, setupData.dev.token).then(
      utils.expectGqlError(err.FINISH_CODE_CONFLICT, resolver),
    );
  });

  test('200 Finish updated with value change', async () => {
    const [product1, product2] = await Promise.all([
      helpers.createProduct({
        body: {
          cost: 10000,
          pricesPerFinishes: [
            {
              finish: ents.objects[0]._id,
              price: 10500,
            },
          ],
        },
      }),
      helpers.createProduct({
        body: {
          cost: 30000,
          pricesPerFinishes: [
            {
              finish: ents.objects[0]._id,
              price: 22050,
            },
          ],
        },
      }),
    ]);

    const object = ents.objects[0];
    const id = object._id.toString();

    const body = createFakeBody({ value: object.value + 1 });

    return baseRequest({ id, input: body }, setupData.dev.token).then(
      async response => {
        // utils.printForDocs(response.body)
        const { finish, error } = response.body.data[resolver];
        expect(error).toBe(null);
        const expected = { ...object.toJSON(), ...body };
        checkResponse(expected, finish);

        const [updatedProduct1, updatedProduct2] = await Promise.all([
          Product.findById(product1._id),
          Product.findById(product2._id),
        ]);
        expect(updatedProduct1?.pricesPerFinishes).toHaveLength(1);
        expect(updatedProduct1?.pricesPerFinishes?.[0].price).not.toBe(10500);
        expect(updatedProduct1?.pricesPerFinishes?.[0].finish.toString()).toBe(
          finish._id.toString(),
        );
        expect(updatedProduct2?.pricesPerFinishes).toHaveLength(1);
        expect(updatedProduct2?.pricesPerFinishes?.[0].price).not.toBe(22050);
        expect(updatedProduct2?.pricesPerFinishes?.[0].finish.toString()).toBe(
          finish._id.toString(),
        );
      },
    );
  });

  test('200 Finish updated without value change', async () => {
    const [product1, product2] = await Promise.all([
      helpers.createProduct({
        body: {
          cost: 10000,
          pricesPerFinishes: [
            {
              finish: ents.objects[1]._id,
              price: 10500,
            },
          ],
        },
      }),
      helpers.createProduct({
        body: {
          cost: 30000,
          pricesPerFinishes: [
            {
              finish: ents.objects[1]._id,
              price: 22050,
            },
          ],
        },
      }),
    ]);

    const object = ents.objects[1];
    const id = object._id.toString();

    const body = createFakeBody({ value: object.value });

    return baseRequest({ id, input: body }, setupData.dev.token).then(
      async response => {
        // utils.printForDocs(response.body);
        const { finish, error } = response.body.data[resolver];
        expect(error).toBe(null);
        const expected = { ...object.toJSON(), ...body };
        checkResponse(expected, finish);

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
