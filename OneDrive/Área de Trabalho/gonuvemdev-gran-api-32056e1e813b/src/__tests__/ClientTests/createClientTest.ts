/* eslint-disable max-lines-per-function */
import app from '../../app';
import * as utils from '../utils';
import * as helpers from '../helpers';
import Factory from '../../factories';
import * as err from '../../middlewares/errorHandling/errors';
import { Role } from '../../enums';
import { ClientInterface } from '../../interfaces';
import * as gqlFieldsQuery from '../gqlFieldsQuery';
import * as checkObjects from '../checkObjects';
import * as gqlInputs from '../gqlInputs';
import { CreateClientInput } from '../../types';

const resolver = 'createClient';

let setupData: helpers.SetupTaskResult;

const createInput = gqlInputs.createInputCreateClient;

const createQuery = ({ input }: { input: CreateClientInput }): string => `
mutation {
  ${resolver}(input: ${createInput(input)}) {
    client ${gqlFieldsQuery.clientFieldsQuery}
    error ${gqlFieldsQuery.errorFieldsQuery}
  }
}`;

const baseRequest = utils.baseGqlRequest(app, createQuery);

const checkResponse = checkObjects.checkClient;

const createFakeBody = (
  body: Partial<ClientInterface> = {},
): Required<ClientInterface> => Factory.build('Client', body);

// eslint-disable-next-line max-lines-per-function
export default (): void => {
  beforeAll(async () => {
    setupData = await helpers.setupTask();
  });

  const fakeBody = createFakeBody();
  utils.testIsGqlAuthenticated(app, resolver, createQuery({ input: fakeBody }));

  const { rolesAllowed, rolesNotAllowed } = helpers.splitRolesByPermission([
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

  /** Verificar referências */
  test('404 Admin not found', async () => {
    const body = createFakeBody();

    return baseRequest({ input: body }, setupData.admin.token).then(
      utils.expectGqlError(err.ADMIN_NOT_FOUND, resolver),
    );
  });

  /** Verificar conflitos */
  test('409 Client primaryPhone conflict', async () => {
    const admin = await helpers.createAdmin({});

    const client = await helpers.createClient({});

    const body = createFakeBody({
      primaryPhone: client.primaryPhone,
      adminWhoRegistered: admin._id,
    });

    return baseRequest({ input: body }, setupData.admin.token).then(
      utils.expectGqlError(err.CLIENT_PRIMARY_PHONE_CONFLICT, resolver),
    );
  });

  test('200 Client created', async () => {
    const { token, admin, user } = await helpers.createAdminUserAndToken();

    admin.user = user;

    const body = createFakeBody({});

    return baseRequest({ input: body }, token).then(response => {
      // utils.printForDocs(response);
      const { client, error } = response.body.data[resolver];
      expect(error).toBe(null);

      checkResponse({ ...body, adminWhoRegistered: admin }, client);
    });
  });

  afterAll(async () => {
    await helpers.dropCollections(['User', 'Client', 'Admin']);
  });
};
