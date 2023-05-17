/* eslint-disable max-lines-per-function */
import { Types } from 'mongoose';

import app from '../../app';
import * as utils from '../utils';
import * as helpers from '../helpers';
import * as err from '../../middlewares/errorHandling/errors';
import { Role } from '../../enums';
import * as gqlFieldsQuery from '../gqlFieldsQuery';
import * as checkObjects from '../checkObjects';
import { ClientDocument, ClientInterface } from '../../interfaces';

const resolver = 'readClient';

const fakeId = Types.ObjectId().toHexString();

let setupData: helpers.SetupTaskResult;

const createQuery = ({ id }: { id: string }): string => `
query {
  ${resolver}(id: "${id}") {
    client ${gqlFieldsQuery.clientFieldsQuery}
    error ${gqlFieldsQuery.errorFieldsQuery}
  }
}
`;

type Ents = { objects: ClientDocument[] };
const createEnts = async (): Promise<Ents> => {
  const o1 = await helpers.createClient({});

  const o2 = await helpers.createClient({});
  await helpers.createOrder({ body: { client: o2._id } });

  const o3 = await helpers.createClient({});
  await helpers.createOrder({ body: { client: o3._id }, size: 2 });

  const objects = [o1, o2, o3];

  return { objects };
};

const baseRequest = utils.baseGqlRequest(app, createQuery);

const checkResponse = (
  expected: ClientDocument,
  received: ClientDocument,
): void => {
  checkObjects.checkClient(expected as Required<ClientInterface>, received);
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

  test('404 Client not found - no client', () => {
    return baseRequest({ id: fakeId }, setupData.dev.token).then(
      utils.expectGqlError(err.CLIENT_NOT_FOUND, resolver),
    );
  });

  let ents: Ents;
  test('404 Client not found - wrong id', async () => {
    ents = await createEnts();

    return baseRequest({ id: fakeId }, setupData.dev.token).then(
      utils.expectGqlError(err.CLIENT_NOT_FOUND, resolver),
    );
  });

  Array.from({ length: 3 }, (v, k) => k).forEach(i => {
    test(`200 Client found - client #${i + 1}`, () => {
      const expected = ents.objects[i];
      return baseRequest(
        { id: expected._id.toString() },
        setupData.dev.token,
      ).then(response => {
        // utils.printForDocs(response.body);
        const { client, error } = response.body.data[resolver];
        expect(error).toBeNull();
        checkResponse(expected, client);
        expect(client.orders).toHaveLength(i);
      });
    });
  });

  afterAll(async () => {
    await helpers.dropCollections(['User', 'Client', 'Admin']);
  });
};
