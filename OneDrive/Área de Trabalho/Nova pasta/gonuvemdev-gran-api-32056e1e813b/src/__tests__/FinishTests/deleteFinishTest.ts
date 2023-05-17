/* eslint-disable max-lines-per-function */
import { Types } from 'mongoose';

import app from '../../app';
import * as utils from '../utils';
import * as helpers from '../helpers';
import * as err from '../../middlewares/errorHandling/errors';
import { Role } from '../../enums';
import * as gqlFieldsQuery from '../gqlFieldsQuery';
import { FinishDocument } from '../../interfaces';

const resolver = 'deleteFinish';

let setupData: helpers.SetupTaskResult;

// eslint-disable-next-line max-lines-per-function
const createQuery = ({ id }: { id: string }): string => `
mutation {
  ${resolver}(id: "${id}") {
    error ${gqlFieldsQuery.errorFieldsQuery}
  }
}`;

const baseRequest = utils.baseGqlRequest(app, createQuery);

const fakeId = Types.ObjectId().toHexString();

type Ents = { objects: FinishDocument[] };
const createEnts = async (): Promise<Ents> => {
  const o1 = await helpers.createFinish({});

  const o2 = await helpers.createFinish({});

  const o3 = await helpers.createFinish({});

  const objects = [o1, o2, o3];

  return { objects };
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

  let ents: Ents;
  test('404 Finish not found', async () => {
    ents = await createEnts();
    return baseRequest({ id: fakeId }, setupData.dev.token).then(
      utils.expectGqlError(err.FINISH_NOT_FOUND, resolver),
    );
  });

  test('422 Finish in use - by product', async () => {
    const { _id } = await helpers.createFinish({ body: { code: 'in_use' } });

    await helpers.createProduct({
      body: { pricesPerFinishes: [{ price: 10000, finish: _id }] },
    });

    return baseRequest({ id: _id }, setupData.dev.token).then(
      utils.expectGqlError(err.FINISH_IN_USE, resolver),
    );
  });

  test('422 Finish in use - by order', async () => {
    const { _id } = await helpers.createFinish({ body: { code: 'in_use2' } });

    const order = await helpers.createOrder({});
    order.items[0].finish = _id;
    await helpers.createOrder({ body: { items: order.items } });

    return baseRequest({ id: _id }, setupData.dev.token).then(
      utils.expectGqlError(err.FINISH_IN_USE, resolver),
    );
  });

  test('200 Finish deleted', () => {
    const id = ents.objects[0]._id;
    return baseRequest({ id }, setupData.dev.token).then(response => {
      // utils.printForDocs(response.body)
      const { error } = response.body.data[resolver];
      expect(error).toBe(null);
    });
  });

  test('404 Finish not found - already deleted', async () => {
    const id = ents.objects[0]._id;
    return baseRequest({ id }, setupData.dev.token).then(
      utils.expectGqlError(err.FINISH_NOT_FOUND, resolver),
    );
  });

  afterAll(async () => {
    await helpers.dropCollections(['Finish', 'User']);
  });
};
