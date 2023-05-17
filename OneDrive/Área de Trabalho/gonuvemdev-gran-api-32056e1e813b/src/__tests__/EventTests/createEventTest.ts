/* eslint-disable max-lines */
/* eslint-disable max-lines-per-function */
import app from '../../app';
import * as utils from '../utils';
import * as helpers from '../helpers';
import Factory from '../../factories';
import * as err from '../../middlewares/errorHandling/errors';
import { Role } from '../../enums';
import {
  ClientDocument,
  EmployeeDocument,
  EventDocument,
  EventInterface,
  OrderDocument,
  OrderInterface,
  ProductDocument,
} from '../../interfaces';
import * as gqlFieldsQuery from '../gqlFieldsQuery';
import * as checkObjects from '../checkObjects';
import * as gqlInputs from '../gqlInputs';
import { CreateEventInput } from '../../types';

const resolver = 'createEvent';

let setupData: helpers.SetupTaskResult;

const createInput = gqlInputs.createInputCreateEvent;

const createQuery = ({ input }: { input: CreateEventInput }): string => `
mutation {
  ${resolver}(input: ${createInput(input)}) {
    event ${gqlFieldsQuery.eventFieldsQuery}
    error ${gqlFieldsQuery.errorFieldsQuery}
  }
}`;

const baseRequest = utils.baseGqlRequest(app, createQuery);

const checkResponse = checkObjects.checkEvent;

const createFakeBody = (
  body: Partial<EventInterface> = {},
): Required<EventInterface> => Factory.build('Event', body);

type Ents = {
  sourceEvent: EventDocument;
  order: OrderDocument;
  client: ClientDocument;
  employees: EmployeeDocument[];
};
async function createEnts(): Promise<Ents> {
  const sourceEvent = await helpers.createEvent({});

  const employee = await helpers.createEmployee({});

  const client = await helpers.createClient({});

  const finish = await helpers.createFinish({});
  const product = (await helpers.createProduct({
    body: { pricesPerFinishes: [{ finish: finish._id, price: 34500 }] },
  })) as Required<ProductDocument>;
  product.pricesPerFinishes[0].finish = finish;
  const { admin, user } = await helpers.createAdminUserAndToken();
  admin.user = user;

  const fakeOrder = Factory.build<OrderInterface>('Order');
  const order = await helpers.createOrder({
    body: {
      client: client._id,
      seller: admin._id,
      intermediator: employee._id,
      items: [
        { ...fakeOrder.items[0], product: product._id, finish: finish._id },
      ],
    },
  });
  order.client = client;
  order.seller = admin;
  order.intermediator = employee;
  order.items = [{ ...fakeOrder.items[0], product, finish }];

  return {
    client,
    employees: [employee],
    order,
    sourceEvent,
  };
}

// eslint-disable-next-line max-lines-per-function
export default (): void => {
  beforeAll(async () => {
    setupData = await helpers.setupTask();
  });

  const fakeBody = createFakeBody();
  utils.testIsGqlAuthenticated(
    app,
    resolver,
    createQuery({ input: fakeBody as CreateEventInput }),
  );

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

  let ents: Ents;

  /** Verificar referências */
  test('404 Event not found', async () => {
    ents = await createEnts();

    const body = createFakeBody({
      order: ents.order._id,
      client: ents.client._id,
      employees: [ents.employees[0]._id],
    });

    return baseRequest({ input: body }, setupData.dev.token).then(
      utils.expectGqlError(err.EVENT_NOT_FOUND, resolver),
    );
  });

  test('404 Order not found', async () => {
    const body = createFakeBody({
      sourceEvent: ents.sourceEvent._id,
      client: ents.client._id,
      employees: [ents.employees[0]._id],
    });

    return baseRequest({ input: body }, setupData.dev.token).then(
      utils.expectGqlError(err.ORDER_NOT_FOUND, resolver),
    );
  });

  test('404 Client not found', async () => {
    const body = createFakeBody({
      sourceEvent: ents.sourceEvent._id,
      order: ents.order._id,
      employees: [ents.employees[0]._id],
    });

    return baseRequest({ input: body }, setupData.dev.token).then(
      utils.expectGqlError(err.CLIENT_NOT_FOUND, resolver),
    );
  });

  test('404 Employee not found', async () => {
    const body = createFakeBody({
      sourceEvent: ents.sourceEvent._id,
      order: ents.order._id,
      client: ents.client._id,
    });

    return baseRequest({ input: body }, setupData.dev.token).then(
      utils.expectGqlError(err.EMPLOYEE_NOT_FOUND, resolver),
    );
  });

  /** Verificar conflitos */

  test('200 Event created', () => {
    const { sourceEvent, order, client, employees } = ents;
    const body = createFakeBody({
      sourceEvent: sourceEvent._id,
      order: order._id,
      client: client._id,
      employees: [employees[0]._id],
    });

    return baseRequest({ input: body }, setupData.dev.token).then(response => {
      const { event, error } = response.body.data[resolver];
      expect(error).toBe(null);

      const expected = { ...body, sourceEvent, order, client, employees };
      checkResponse(expected, event);
    });
  });

  afterAll(async () => {
    await helpers.dropCollections([
      'User',
      'Event',
      'Order',
      'Client',
      'Employee',
    ]);
  });
};
