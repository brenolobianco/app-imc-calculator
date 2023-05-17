/* eslint-disable max-lines-per-function */
import { Types } from 'mongoose';

import app from '../../app';
import * as utils from '../utils';
import * as helpers from '../helpers';
import Factory from '../../factories';
import * as err from '../../middlewares/errorHandling/errors';
import { Role } from '../../enums';
import {
  UserDocument,
  UserInterface,
  AdminDocument,
  AdminInterface,
} from '../../interfaces';
import * as gqlFieldsQuery from '../gqlFieldsQuery';
import * as checkObjects from '../checkObjects';
import { UpdateAdminInput } from '../../types';
import * as gqlInputs from '../gqlInputs';

const resolver = 'updateAdmin';

const fakeId = Types.ObjectId().toHexString();

let setupData: helpers.SetupTaskResult;

const createInput = gqlInputs.createInputUpdateAdmin;

const createQuery = ({
  id,
  input,
}: {
  id: string;
  input: UpdateAdminInput;
}): string => `
mutation {
  ${resolver}(id: "${id}", input: ${createInput(input)}) {
    admin ${gqlFieldsQuery.adminFieldsQuery}
    error ${gqlFieldsQuery.errorFieldsQuery}
  }
}`;

const baseRequest = utils.baseGqlRequest(app, createQuery);

const checkResponse = (
  expected: AdminDocument,
  received: AdminDocument,
): void => {
  checkObjects.checkAdmin(expected as Required<AdminInterface>, received);
  expect(received).toMatchObject({
    _id: expected._id.toString(),
  });
};

const createFakeBody = (
  userBody: Partial<UserInterface> = {},
  adminBody: Partial<AdminInterface> = {},
): UpdateAdminInput => {
  const { name, email, roles } = Factory.build<UserDocument>('User', {
    ...userBody,
  });
  const { employee } = Factory.build<AdminInterface>('Admin', {
    ...adminBody,
  });

  return { name, email, roles, employee };
};

type Ents = { objects: AdminDocument[] };
const createEnts = async (): Promise<Ents> => {
  const u1 = await helpers.createUser({ body: { roles: [Role.Admin] } });

  const u2 = await helpers.createUser({ body: { roles: [Role.Admin] } });

  const o1 = await helpers.createAdmin({ body: { user: u1._id } });
  const o2 = await helpers.createAdmin({ body: { user: u2._id } });

  o1.user = u1;
  o2.user = u2;

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

  test('404 Admin not found - no admin', async () => {
    const body = createFakeBody();

    return baseRequest({ id: fakeId, input: body }, setupData.dev.token).then(
      utils.expectGqlError(err.ADMIN_NOT_FOUND, resolver),
    );
  });

  let ents: Ents;
  test('404 Admin not found - wrong id', async () => {
    ents = await createEnts();
    const body = createFakeBody();
    return baseRequest({ id: fakeId, input: body }, setupData.dev.token).then(
      utils.expectGqlError(err.ADMIN_NOT_FOUND, resolver),
    );
  });

  const userConflictTests = [
    { uniqueField: 'email', error: err.EMAIL_CONFLICT },
  ];
  userConflictTests.forEach(({ uniqueField, error }) => {
    test(`409 User conflict - same ${uniqueField}`, async () => {
      const id = ents.objects[0]._id.toString();

      const userBody = {
        [uniqueField]: setupData.dev.fact[uniqueField as keyof UserInterface],
      };

      const body = createFakeBody(userBody);

      return baseRequest({ id, input: body }, setupData.dev.token).then(
        utils.expectGqlError(error, resolver),
      );
    });
  });

  test('404 Employee not found', async () => {
    const object = ents.objects[0];
    const id = object._id.toString();

    const body = createFakeBody();

    return baseRequest({ id, input: body }, setupData.dev.token).then(
      utils.expectGqlError(err.EMPLOYEE_NOT_FOUND, resolver),
    );
  });

  test('200 Admin updated', async () => {
    const object = ents.objects[0];
    const id = object._id.toString();

    const employee = await helpers.createEmployee({});

    const body = createFakeBody({}, { employee: employee._id });

    return baseRequest({ id, input: body }, setupData.dev.token).then(
      response => {
        // utils.printForDocs(response.body)
        const { admin, error } = response.body.data[resolver];
        expect(error).toBe(null);
        const { ...user } = body;
        const expected = { ...object.toJSON(), user, employee };
        checkResponse(expected, admin);
      },
    );
  });

  afterAll(async () => {
    await helpers.dropCollections(['User', 'Admin']);
  });
};
