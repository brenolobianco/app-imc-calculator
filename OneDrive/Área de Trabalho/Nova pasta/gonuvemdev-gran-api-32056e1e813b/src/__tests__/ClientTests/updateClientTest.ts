/* eslint-disable max-lines-per-function */
import { Types } from 'mongoose';

import app from '../../app';
import * as utils from '../utils';
import * as helpers from '../helpers';
import Factory from '../../factories';
import * as err from '../../middlewares/errorHandling/errors';
import { Role } from '../../enums';
import { ClientDocument, ClientInterface } from '../../interfaces';
import * as gqlFieldsQuery from '../gqlFieldsQuery';
import * as checkObjects from '../checkObjects';
import { UpdateClientInput } from '../../types';
import * as gqlInputs from '../gqlInputs';

const resolver = 'updateClient';

const fakeId = Types.ObjectId().toHexString();

let setupData: helpers.SetupTaskResult;

const createInput = gqlInputs.createInputUpdateClient;

const createQuery = ({
  id,
  input,
}: {
  id: string;
  input: Required<UpdateClientInput>;
}): string => `
mutation {
  ${resolver}(id: "${id}", input: ${createInput(input)}) {
    client ${gqlFieldsQuery.clientFieldsQuery}
    error ${gqlFieldsQuery.errorFieldsQuery}
  }
}`;

const baseRequest = utils.baseGqlRequest(app, createQuery);

const checkResponse = (
  expected: ClientDocument,
  received: ClientDocument,
): void => {
  checkObjects.checkClient(expected as Required<ClientInterface>, received);
  expect(received).toMatchObject({
    _id: expected._id.toString(),
  });
};

const createFakeBody = (
  body: Partial<ClientInterface> = {},
): Required<ClientInterface> =>
  Factory.build<Required<ClientInterface>>('Client', body);

type Ents = { objects: ClientDocument[] };
const createEnts = async (): Promise<Ents> => {
  const o1 = await helpers.createClient({});

  const o2 = await helpers.createClient({});

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

  test('404 Client not found - no client', async () => {
    const body = createFakeBody();

    return baseRequest({ id: fakeId, input: body }, setupData.dev.token).then(
      utils.expectGqlError(err.CLIENT_NOT_FOUND, resolver),
    );
  });

  let ents: Ents;
  test('404 Client not found - wrong id', async () => {
    ents = await createEnts();
    const body = createFakeBody();
    return baseRequest({ id: fakeId, input: body }, setupData.dev.token).then(
      utils.expectGqlError(err.CLIENT_NOT_FOUND, resolver),
    );
  });

  /** Verificar conflitos */
  test('409 Client primaryPhone conflict', async () => {
    const admin = await helpers.createAdmin({});
    const client = await helpers.createClient({});
    const object = ents.objects[0];
    const id = object._id.toString();

    const body = createFakeBody({
      primaryPhone: client.primaryPhone,
      adminWhoRegistered: admin._id,
    });

    return baseRequest({ id, input: body }, setupData.dev.token).then(
      utils.expectGqlError(err.CLIENT_PRIMARY_PHONE_CONFLICT, resolver),
    );
  });

  test('200 Client updated', async () => {
    const admin = await helpers.createAdmin({});
    const object = ents.objects[0];
    const id = object._id.toString();

    const body = createFakeBody({ adminWhoRegistered: admin._id });

    return baseRequest({ id, input: body }, setupData.dev.token).then(
      response => {
        // utils.printForDocs(response.body)
        const { client, error } = response.body.data[resolver];
        expect(error).toBe(null);
        const expected = { ...object.toJSON(), ...body };
        checkResponse(expected, client);
      },
    );
  });

  afterAll(async () => {
    await helpers.dropCollections(['User', 'Client', 'Admin']);
  });
};
