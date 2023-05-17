/* eslint-disable max-lines-per-function */
import { Types } from 'mongoose';

import app from '../../app';
import * as utils from '../utils';
import * as helpers from '../helpers';
import * as err from '../../middlewares/errorHandling/errors';
import { Role } from '../../enums';
import * as gqlFieldsQuery from '../gqlFieldsQuery';
import { OrderDocument } from '../../interfaces';
import Event from '../../models/Event';

const resolver = 'deleteOrder';

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

type Ents = { objects: OrderDocument[] };
const createEnts = async (): Promise<Ents> => {
  const o1 = await helpers.createOrder({});

  const o2 = await helpers.createOrder({});

  const o3 = await helpers.createOrder({});

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
  test('404 Order not found', async () => {
    ents = await createEnts();
    return baseRequest({ id: fakeId }, setupData.dev.token).then(
      utils.expectGqlError(err.ORDER_NOT_FOUND, resolver),
    );
  });

  /** Verificar se está em uso por outros objetos */
  test('200 Order deleted - unlinking events', async () => {
    const { _id } = await helpers.createOrder({});

    const events = await Promise.all([
      helpers.createEvent({ body: { order: _id } }),
      helpers.createEvent({ body: { order: _id } }),
      helpers.createEvent({ body: { order: _id } }),
    ]);

    return baseRequest({ id: _id }, setupData.dev.token).then(
      async response => {
        // utils.printForDocs(response.body)
        const { error } = response.body.data[resolver];
        expect(error).toBe(null);
        const evts = await Event.find({ _id: { $in: events.map(e => e._id) } });
        expect(evts).toHaveLength(3);
        evts.forEach(e => expect(e.order).toBeNull());
      },
    );
  });

  test('200 Order deleted', () => {
    const id = ents.objects[0]._id;
    return baseRequest({ id }, setupData.dev.token).then(response => {
      // utils.printForDocs(response.body)
      const { error } = response.body.data[resolver];
      expect(error).toBe(null);
    });
  });

  test('404 Order not found - already deleted', async () => {
    const id = ents.objects[0]._id;
    return baseRequest({ id }, setupData.dev.token).then(
      utils.expectGqlError(err.ORDER_NOT_FOUND, resolver),
    );
  });

  afterAll(async () => {
    await helpers.dropCollections([
      'User',
      'Order',
      'Order',
      'Order',
      'Client',
      'Employee',
    ]);
  });
};
