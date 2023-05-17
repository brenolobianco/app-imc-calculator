/* eslint-disable max-lines-per-function */
import { Types } from 'mongoose';

import app from '../../app';
import * as utils from '../utils';
import * as helpers from '../helpers';
import Factory from '../../factories';
import * as err from '../../middlewares/errorHandling/errors';
import { Role } from '../../enums';
import { EmployeeDocument, EmployeeInterface } from '../../interfaces';
import * as gqlFieldsQuery from '../gqlFieldsQuery';
import * as checkObjects from '../checkObjects';
import { UpdateEmployeeInput } from '../../types';
import * as gqlInputs from '../gqlInputs';

const resolver = 'updateEmployee';

const fakeId = Types.ObjectId().toHexString();

let setupData: helpers.SetupTaskResult;

const createInput = gqlInputs.createInputUpdateEmployee;

const createQuery = ({
  id,
  input,
}: {
  id: string;
  input: Required<UpdateEmployeeInput>;
}): string => `
mutation {
  ${resolver}(id: "${id}", input: ${createInput(input)}) {
    employee ${gqlFieldsQuery.employeeFieldsQuery}
    error ${gqlFieldsQuery.errorFieldsQuery}
  }
}`;

const baseRequest = utils.baseGqlRequest(app, createQuery);

const checkResponse = (
  expected: EmployeeDocument,
  received: EmployeeDocument,
): void => {
  checkObjects.checkEmployee(expected as Required<EmployeeInterface>, received);
  expect(received).toMatchObject({
    _id: expected._id.toString(),
  });
};

const createFakeBody = (
  body: Partial<EmployeeInterface> = {},
): Required<EmployeeInterface> =>
  Factory.build<Required<EmployeeInterface>>('Employee', body);

type Ents = { objects: EmployeeDocument[] };
const createEnts = async (): Promise<Ents> => {
  const o1 = await helpers.createEmployee({});

  const o2 = await helpers.createEmployee({});

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

  test('404 Employee not found - no employee', async () => {
    const body = createFakeBody();

    return baseRequest({ id: fakeId, input: body }, setupData.dev.token).then(
      utils.expectGqlError(err.EMPLOYEE_NOT_FOUND, resolver),
    );
  });

  let ents: Ents;
  test('404 Employee not found - wrong id', async () => {
    ents = await createEnts();
    const body = createFakeBody();
    return baseRequest({ id: fakeId, input: body }, setupData.dev.token).then(
      utils.expectGqlError(err.EMPLOYEE_NOT_FOUND, resolver),
    );
  });

  test('200 Employee updated', async () => {
    const object = ents.objects[0];
    const id = object._id.toString();

    const body = createFakeBody();

    return baseRequest({ id, input: body }, setupData.dev.token).then(
      response => {
        // utils.printForDocs(response.body);
        const { employee, error } = response.body.data[resolver];
        expect(error).toBe(null);
        const expected = { ...object.toJSON(), ...body };
        checkResponse(expected, employee);
      },
    );
  });

  afterAll(async () => {
    await helpers.dropCollections(['User', 'Employee']);
  });
};
