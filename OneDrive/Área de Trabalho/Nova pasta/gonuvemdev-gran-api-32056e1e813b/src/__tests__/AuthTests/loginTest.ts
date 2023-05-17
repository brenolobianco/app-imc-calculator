/* eslint-disable max-lines-per-function */
import Factory from '../../factories';
import app from '../../app';
import * as utils from '../utils';
import * as helpers from '../helpers';
import * as err from '../../middlewares/errorHandling/errors';
import { Role } from '../../enums';
import * as gqlFieldsQuery from '../gqlFieldsQuery';
import * as checkObjects from '../checkObjects';
import {
  UserInterface,
  UserDocument,
  AdminDocument,
  UserDoc,
  EmployeeDocument,
} from '../../interfaces';
import { LoginParams, LoginResponse } from '../../types';

const resolver = 'login';

// eslint-disable-next-line max-lines-per-function
const createQuery = ({ email, password }: LoginParams): string => `
mutation {
  ${resolver}(email: "${email}", password: "${password}") {
    token
    info {
      _id
      user ${gqlFieldsQuery.userFieldsQuery}
      commission
      employeeName
    }
    error ${gqlFieldsQuery.errorFieldsQuery}
  }
}
`;

const baseRequest = utils.baseGqlRequest(app, createQuery);

type Ents = {
  dev: { user: Partial<UserDocument> };
  admin: AdminDocument;
  adminEmployee: AdminDocument;
};

const createEnts = async (): Promise<Ents> => {
  const roles = [[Role.Dev], [Role.Admin]];

  const createUserFact = (body: Partial<UserDoc>): UserInterface =>
    Factory.build<UserInterface>('User', body);

  const factories = roles.map(role => createUserFact({ roles: role }));

  const users = await Promise.all<UserDocument>(
    factories.map(fact => helpers.createUser({ body: fact })),
  );

  users[0].password = factories[0].password;
  users[1].password = factories[1].password;

  const dev = { user: users[0] };

  const adminUser = users[1];

  const admin = await helpers.createAdmin({ body: { user: adminUser._id } });
  admin.user = adminUser;

  const userFact = createUserFact({ roles: [Role.Admin] });
  const userEmployee = await helpers.createUser({ body: userFact });
  const employee = await helpers.createEmployee({});
  const adminEmployee = await helpers.createAdmin({
    body: { user: userEmployee._id, employee: employee._id },
  });
  userEmployee.password = userFact.password;
  adminEmployee.user = userEmployee;
  adminEmployee.employee = employee;

  return { dev, admin, adminEmployee };
};

const checkResponse = checkObjects.checkUser;

let setupData: helpers.SetupTaskResult;
// eslint-disable-next-line max-lines-per-function
export default (): void => {
  beforeAll(async () => {
    setupData = await helpers.setupTask();
  });

  test('404 User not found', () => {
    return baseRequest({ email: 'a@email.com', password: '123abc' }).then(
      utils.expectGqlError(err.USER_NOT_FOUND, resolver),
    );
  });

  let ents: Ents;
  test('422 Password incorrect', async () => {
    ents = await createEnts();
    return baseRequest({
      email: setupData.dev.fact.email,
      password: '123abc',
    }).then(utils.expectGqlError(err.PASSWORD_INCORRECT, resolver));
  });

  Object.values(Role).forEach(role => {
    ['email'].forEach(loginMethod => {
      test(`200 Login OK for ${role} with ${loginMethod} without commission`, () => {
        const expected = ents[role];

        const { password, email } = expected.user as UserDocument;

        return baseRequest({ email, password }).then(response => {
          // utils.printForDocs(response.body);
          const { token, info }: LoginResponse = response.body.data[resolver];

          expect(token).not.toBeNull();
          if (role === Role.Dev) expect(info?._id).toBeNull();
          else expect(info?._id?.toString()).toBe(ents.admin._id.toString());

          checkResponse(
            expected.user as UserDocument,
            info?.user as UserDocument,
          );
          expect(info?.commission).toBeNull();
        });
      });
    });
  });

  test('200 Login OK for admin employee with commission and employeeName', () => {
    const expected = ents.adminEmployee;

    const { password, email } = expected.user as UserDocument;

    return baseRequest({ email, password }).then(response => {
      // utils.printForDocs({ email, password });
      // utils.printForDocs(response.body);
      const { token, info }: LoginResponse = response.body.data[resolver];

      expect(token).not.toBeNull();

      expect(info?._id?.toString()).toBe(expected._id.toString());

      checkResponse(expected.user as UserDocument, info?.user as UserDocument);

      const employee = expected.employee as EmployeeDocument;
      expect(info?.commission).toBe(employee.commission);
      expect(info?.employeeName).toBe(employee.name);
    });
  });

  afterAll(async () => {
    await helpers.dropCollections(['User', 'Admin', 'Employee']);
  });
};
