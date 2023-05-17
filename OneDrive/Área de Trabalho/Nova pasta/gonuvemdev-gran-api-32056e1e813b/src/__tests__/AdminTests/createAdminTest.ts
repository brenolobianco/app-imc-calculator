/* eslint-disable max-lines-per-function */
import app from '../../app';
import * as utils from '../utils';
import * as helpers from '../helpers';
import Factory from '../../factories';
import * as err from '../../middlewares/errorHandling/errors';
import { Role } from '../../enums';
import { AdminInterface, UserDocument, UserInterface } from '../../interfaces';
import * as gqlFieldsQuery from '../gqlFieldsQuery';
import * as checkObjects from '../checkObjects';
import * as gqlInputs from '../gqlInputs';
import { CreateAdminInput } from '../../types';

const resolver = 'createAdmin';

let setupData: helpers.SetupTaskResult;

const createInput = gqlInputs.createInputCreateAdmin;

const createQuery = ({ input }: { input: CreateAdminInput }): string => `
mutation {
  ${resolver}(input: ${createInput(input)}) {
    admin ${gqlFieldsQuery.adminFieldsQuery}
    error ${gqlFieldsQuery.errorFieldsQuery}
  }
}`;

const baseRequest = utils.baseGqlRequest(app, createQuery);

const createFakeBody = (
  userBody: Partial<UserInterface> = {},
  adminBody: Partial<AdminInterface> = {},
): CreateAdminInput => {
  const { name, email, password, roles } = Factory.build<UserDocument>('User', {
    ...userBody,
  });
  const { employee } = Factory.build<AdminInterface>('Admin', {
    ...adminBody,
  });

  return { name, email, password, roles, employee };
};

const checkResponse = checkObjects.checkAdmin;

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

  const userConflictTests = [
    { uniqueField: 'email', error: err.EMAIL_CONFLICT },
  ];
  userConflictTests.forEach(({ uniqueField, error }) => {
    test(`409 User conflict - same ${uniqueField}`, async () => {
      const employee = await helpers.createEmployee({});

      const userBody = {
        [uniqueField]: setupData.dev.fact[uniqueField as keyof UserInterface],
      };

      const body = createFakeBody(userBody, { employee: employee._id });

      return baseRequest({ input: body }, setupData.dev.token).then(
        utils.expectGqlError(error, resolver),
      );
    });
  });

  test('404 Employee not found', async () => {
    const body = createFakeBody();

    return baseRequest({ input: body }, setupData.dev.token).then(
      utils.expectGqlError(err.EMPLOYEE_NOT_FOUND, resolver),
    );
  });

  test('200 Admin created', async () => {
    const employee = await helpers.createEmployee({});

    const body = createFakeBody({}, { employee: employee._id });

    return baseRequest({ input: body }, setupData.dev.token).then(response => {
      //  utils.printForDocs(response);
      const { admin, error } = response.body.data[resolver];
      expect(error).toBe(null);
      const { ...user } = body;

      const expected = { user, employee };

      checkResponse(expected, admin);
    });
  });

  afterAll(async () => {
    await helpers.dropCollections(['User', 'Admin']);
  });
};
