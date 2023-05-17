/* eslint-disable max-lines-per-function */
import { Types } from 'mongoose';

import app from '../../app';
import * as utils from '../utils';
import * as helpers from '../helpers';
import * as err from '../../middlewares/errorHandling/errors';
import { Role } from '../../enums';
import * as gqlFieldsQuery from '../gqlFieldsQuery';
import * as checkObjects from '../checkObjects';
import {
  EventDocument,
  EventInterface,
  OrderInterface,
  ProductDocument,
} from '../../interfaces';
import Factory from '../../factories';

const resolver = 'readEvent';

const fakeId = Types.ObjectId().toHexString();

let setupData: helpers.SetupTaskResult;

const createQuery = ({ id }: { id: string }): string => `
query {
  ${resolver}(id: "${id}") {
    event ${gqlFieldsQuery.eventFieldsQuery}
    error ${gqlFieldsQuery.errorFieldsQuery}
  }
}
`;

type Ents = { objects: EventDocument[] };
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

  const order1 = await helpers.createOrder({
    body: {
      seller: res1.admin._id,
      intermediator: employee1._id,
      client: client1._id,
      items: [item1],
    },
  });
  order1.seller = res1.admin;
  order1.intermediator = employee1;
  order1.client = client1;
  order1.items = [populatedItem];

  const order2 = await helpers.createOrder({
    body: {
      seller: res2.admin._id,
      intermediator: employee2._id,
      client: client2._id,
      items: [item1],
    },
  });
  order2.seller = res2.admin;
  order2.intermediator = employee2;
  order2.client = client2;
  order2.items = [populatedItem];

  const order3 = await helpers.createOrder({
    body: {
      seller: res3.admin._id,
      intermediator: employee3._id,
      client: client3._id,
      items: [item1],
    },
  });
  order3.seller = res3.admin;
  order3.intermediator = employee3;
  order3.client = client3;
  order3.items = [populatedItem];

  const o1 = await helpers.createEvent({
    body: {
      client: client1._id,
      order: order1._id,
      sourceEvent: undefined,
      employees: [employee1._id],
    },
  });
  o1.client = client1;
  o1.order = order1;
  o1.employees = [employee1];

  const o2 = await helpers.createEvent({
    body: {
      client: client2._id,
      order: order2._id,
      sourceEvent: o1._id,
      employees: [employee2._id],
    },
  });
  o2.client = client2;
  o2.order = order2;
  o2.sourceEvent = o1;
  o2.employees = [employee2];

  const o3 = await helpers.createEvent({
    body: {
      client: client3._id,
      order: order3._id,
      sourceEvent: undefined,
      employees: [employee3._id],
    },
  });
  o3.client = client3;
  o3.order = order3;
  o3.employees = [employee3];

  const objects = [o1, o2, o3];

  return { objects };
};

const baseRequest = utils.baseGqlRequest(app, createQuery);

const checkResponse = (
  expected: EventDocument,
  received: EventDocument,
): void => {
  checkObjects.checkEvent(expected as Required<EventInterface>, received);
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

  test('404 Event not found - no event', () => {
    return baseRequest({ id: fakeId }, setupData.dev.token).then(
      utils.expectGqlError(err.EVENT_NOT_FOUND, resolver),
    );
  });

  let ents: Ents;
  test('404 Event not found - wrong id', async () => {
    ents = await createEnts();

    return baseRequest({ id: fakeId }, setupData.dev.token).then(
      utils.expectGqlError(err.EVENT_NOT_FOUND, resolver),
    );
  });

  Array.from({ length: 3 }, (v, k) => k).forEach(i => {
    test(`200 Event found - event #${i + 1}`, () => {
      const expected = ents.objects[i];
      return baseRequest(
        { id: expected._id.toString() },
        setupData.dev.token,
      ).then(response => {
        const { event, error } = response.body.data[resolver];
        expect(error).toBeNull();
        checkResponse(expected, event);
      });
    });
  });

  afterAll(async () => {
    await helpers.dropCollections([
      'User',
      'Event',
      'Order',
      'Client',
      'Employee',
    ]);
  });
};
