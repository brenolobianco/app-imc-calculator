/* eslint-disable max-lines-per-function */
import app from '../../app';
import * as utils from '../utils';
import * as helpers from '../helpers';
import Factory from '../../factories';
import * as err from '../../middlewares/errorHandling/errors';
import { Role } from '../../enums';
import { EmployeeInterface } from '../../interfaces';
import * as gqlFieldsQuery from '../gqlFieldsQuery';
import * as checkObjects from '../checkObjects';
import * as gqlInputs from '../gqlInputs';
import { CreateEmployeeInput } from '../../types';

const resolver = 'createEmployee';

let setupData: helpers.SetupTaskResult;

const createInput = gqlInputs.createInputCreateEmployee;

const createQuery = ({ input }: { input: CreateEmployeeInput }): string => `
mutation {
  ${resolver}(input: ${createInput(input)}) {
    employee ${gqlFieldsQuery.employeeFieldsQuery}
    error ${gqlFieldsQuery.errorFieldsQuery}
  }
}`;

const baseRequest = utils.baseGqlRequest(app, createQuery);

const checkResponse = checkObjects.checkEmployee;

const createFakeBody = (
  body: Partial<EmployeeInterface> = {},
): Required<EmployeeInterface> => {
  return Factory.build<Required<EmployeeInterface>>('Employee', body);
};

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

  test('200 Employee created', async () => {
    const body = createFakeBody();

    return baseRequest({ input: body }, setupData.dev.token).then(response => {
      // utils.printForDocs(response)
      const { employee, error } = response.body.data[resolver];
      expect(error).toBe(null);

      checkResponse(body, employee);
    });
  });

  afterAll(async () => {
    await helpers.dropCollections(['User', 'Employee']);
  });
};
