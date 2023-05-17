/* eslint-disable max-lines */
/* eslint-disable max-lines-per-function */
import app from '../../app';
import * as utils from '../utils';
import * as helpers from '../helpers';
import * as err from '../../middlewares/errorHandling/errors';
import { Role } from '../../enums';
import * as gqlFieldsQuery from '../gqlFieldsQuery';

const resolver = 'listEmployeesOccupations';

let setupData: helpers.SetupTaskResult;

const createQuery = (): string => `
query {
  ${resolver} {
    occupations
    error ${gqlFieldsQuery.errorFieldsQuery}
  }
}
`;

type Ents = { occupations: string[] };
const createEnts = async (): Promise<Ents> => {
  const occupations = ['Diretor', 'Operário', 'Vendedor(a)'];

  await helpers.createEmployee({
    body: { occupation: 'Diretor' },
    size: 3,
  });

  await helpers.createEmployee({
    body: { occupation: 'Operário' },
    size: 2,
  });

  await helpers.createEmployee({
    body: { occupation: 'Vendedor(a)' },
    size: 4,
  });

  return { occupations };
};

const baseRequest = utils.baseGqlRequest(app, createQuery);

// eslint-disable-next-line max-lines-per-function
export default (): void => {
  beforeAll(async () => {
    setupData = await helpers.setupTask();
  });

  utils.testIsGqlAuthenticated(app, resolver, createQuery());

  const { rolesAllowed, rolesNotAllowed } = helpers.splitRolesByPermission([
    Role.Dev,
    Role.Admin,
  ]);

  rolesNotAllowed.forEach(role => {
    test(`403 ${role} not allowed`, () => {
      return baseRequest({}, setupData[role].token).then(
        utils.expectGqlError(err.USER_NOT_ALLOWED, resolver),
      );
    });
  });

  rolesAllowed.forEach(role => {
    test(`Not 403 - ${role} allowed`, () => {
      return baseRequest({}, setupData[role].token).then(response => {
        expect(response.status).not.toBe(403);
      });
    });
  });

  test('200 Occupations empty list - no employees', () => {
    return baseRequest({}, setupData.dev.token).then(response => {
      const { occupations } = response.body.data[resolver];
      expect(occupations).toHaveLength(0);
    });
  });

  let ents: Ents;
  test('200 Occupations found', async () => {
    ents = await createEnts();
    return baseRequest({}, setupData.dev.token).then(response => {
      // utils.printForDocs(response.body);
      const { occupations } = response.body.data[resolver] as {
        occupations: string[];
      };
      occupations.forEach((occupation, i) => {
        expect(occupation).toMatch(ents.occupations[i]);
      });
    });
  });

  afterAll(async () => {
    await helpers.dropCollections(['Employee', 'User']);
  });
};
