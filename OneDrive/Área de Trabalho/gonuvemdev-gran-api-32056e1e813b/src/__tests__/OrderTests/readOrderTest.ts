/* eslint-disable max-lines-per-function */
import { Types } from 'mongoose';

import app from '../../app';
import Factory from '../../factories';
import * as utils from '../utils';
import * as helpers from '../helpers';
import * as err from '../../middlewares/errorHandling/errors';
import { Role } from '../../enums';
import * as gqlFieldsQuery from '../gqlFieldsQuery';
import * as checkObjects from '../checkObjects';
import {
  OrderDocument,
  OrderInterface,
  ProductDocument,
} from '../../interfaces';

const resolver = 'readOrder';

const fakeId = Types.ObjectId().toHexString();

let setupData: helpers.SetupTaskResult;

const createQuery = ({ id }: { id: string }): string => `
query {
  ${resolver}(id: "${id}") {
    order ${gqlFieldsQuery.orderFieldsQuery}
    error ${gqlFieldsQuery.errorFieldsQuery}
  }
}
`;

type Ents = { objects: OrderDocument[] };
const createEnts = async (): Promise<Ents> => {
  const [res1, res2, res3] = await Promise.all([
    helpers.createAdminUserAndToken(),
    helpers.createAdminUserAndToken(),
    helpers.createAdminUserAndToken(),
  ]);
  res1.admin.user = res1.user;
  res2.admin.user = res2.user;
  res3.admin.user = res3.user;

  const [employee1, employee2, employee3] = await Promise.all([
    helpers.createEmployee({}),
    helpers.createEmployee({}),
    helpers.createEmployee({}),
  ]);

  const [client1, client2, client3] = await Promise.all([
    helpers.createClient({}),
    helpers.createClient({}),
    helpers.createClient({}),
  ]);

  const finish = await helpers.createFinish({});
  const product = (await helpers.createProduct({
    body: { pricesPerFinishes: [{ finish: finish._id, price: 34500 }] },
  })) as Required<ProductDocument>;
  product.pricesPerFinishes[0].finish = finish;

  const fakeOrder = Factory.build<OrderInterface>('Order');

  const item1 = {
    ...fakeOrder.items[0],
    product: product._id,
    finish: finish._id,
  };

  const populatedItem = {
    ...fakeOrder.items[0],
    product,
    finish,
  };

  const o1 = await helpers.createOrder({
    body: {
      seller: res1.admin._id,
      intermediator: employee1._id,
      client: client1._id,
      items: [item1],
    },
  });
  o1.seller = res1.admin;
  o1.intermediator = employee1;
  o1.client = client1;
  o1.items = [populatedItem];

  const o2 = await helpers.createOrder({
    body: {
      seller: res2.admin._id,
      intermediator: employee2._id,
      client: client2._id,
      items: [item1],
    },
  });
  o2.seller = res2.admin;
  o2.intermediator = employee2;
  o2.client = client2;
  o2.items = [populatedItem];

  const o3 = await helpers.createOrder({
    body: {
      seller: res3.admin._id,
      intermediator: employee3._id,
      client: client3._id,
      items: [item1],
    },
  });
  o3.seller = res3.admin;
  o3.intermediator = employee3;
  o3.client = client3;
  o3.items = [populatedItem];

  const objects = [o1, o2, o3];

  return { objects };
};

const baseRequest = utils.baseGqlRequest(app, createQuery);

const checkResponse = (
  expected: OrderDocument,
  received: OrderDocument,
): void => {
  checkObjects.checkOrder(expected as Required<OrderInterface>, received);
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

  test('404 Order not found - no order', () => {
    return baseRequest({ id: fakeId }, setupData.dev.token).then(
      utils.expectGqlError(err.ORDER_NOT_FOUND, resolver),
    );
  });

  let ents: Ents;
  test('404 Order not found - wrong id', async () => {
    ents = await createEnts();

    return baseRequest({ id: fakeId }, setupData.dev.token).then(
      utils.expectGqlError(err.ORDER_NOT_FOUND, resolver),
    );
  });

  Array.from({ length: 3 }, (v, k) => k).forEach(i => {
    test(`200 Order found - order #${i + 1}`, () => {
      const expected = ents.objects[i];
      return baseRequest(
        { id: expected._id.toString() },
        setupData.dev.token,
      ).then(response => {
        const { order, error } = response.body.data[resolver];
        expect(error).toBeNull();
        checkResponse(expected, order);
      });
    });
  });

  afterAll(async () => {
    await helpers.dropCollections([
      'User',
      'Order',
      'Client',
      'Admin',
      'Employee',
      'Product',
      'Finish',
    ]);
  });
};
