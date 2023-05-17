/* eslint-disable max-lines-per-function */
import { Types } from 'mongoose';

import app from '../../app';
import * as utils from '../utils';
import * as helpers from '../helpers';
import * as err from '../../middlewares/errorHandling/errors';
import { Role } from '../../enums';
import * as gqlFieldsQuery from '../gqlFieldsQuery';
import { EmployeeDocument } from '../../interfaces';

const resolver = 'deleteEmployee';

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

type Ents = { objects: EmployeeDocument[] };
const createEnts = async (): Promise<Ents> => {
  const o1 = await helpers.createEmployee({});

  const o2 = await helpers.createEmployee({});

  const o3 = await helpers.createEmployee({});

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
  test('404 Employee not found', async () => {
    ents = await createEnts();
    return baseRequest({ id: fakeId }, setupData.dev.token).then(
      utils.expectGqlError(err.EMPLOYEE_NOT_FOUND, resolver),
    );
  });

  test('422 Employee in use - by admin', async () => {
    const { _id } = await helpers.createEmployee({});

    await helpers.createAdmin({ body: { employee: _id } });

    return baseRequest({ id: _id }, setupData.dev.token).then(
      utils.expectGqlError(err.EMPLOYEE_IN_USE, resolver),
    );
  });

  test('422 Employee in use - by order', async () => {
    const { _id } = await helpers.createEmployee({});

    await helpers.createOrder({ body: { intermediator: _id } });

    return baseRequest({ id: _id }, setupData.dev.token).then(
      utils.expectGqlError(err.EMPLOYEE_IN_USE, resolver),
    );
  });

  test('200 Employee deleted', () => {
    const id = ents.objects[0]._id;
    return baseRequest({ id }, setupData.dev.token).then(response => {
      // utils.printForDocs(response.body)
      const { error } = response.body.data[resolver];
      expect(error).toBe(null);
    });
  });

  test('404 Employee not found - already deleted', async () => {
    const id = ents.objects[0]._id;
    return baseRequest({ id }, setupData.dev.token).then(
      utils.expectGqlError(err.EMPLOYEE_NOT_FOUND, resolver),
    );
  });

  afterAll(async () => {
    await helpers.dropCollections(['Employee', 'User']);
  });
};
