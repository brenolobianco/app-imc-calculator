/* eslint-disable max-lines-per-function */
import { Types } from 'mongoose';

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
import { ID, UpdateEventInput } from '../../types';
import * as gqlInputs from '../gqlInputs';

const resolver = 'updateEvent';

const fakeId = Types.ObjectId().toHexString();

let setupData: helpers.SetupTaskResult;

const createInput = gqlInputs.createInputUpdateEvent;

const createQuery = ({
  id,
  input,
}: {
  id: string;
  input: Required<UpdateEventInput>;
}): string => `
mutation {
  ${resolver}(id: "${id}", input: ${createInput(input)}) {
    event ${gqlFieldsQuery.eventFieldsQuery}
    error ${gqlFieldsQuery.errorFieldsQuery}
  }
}`;

const baseRequest = utils.baseGqlRequest(app, createQuery);

const checkResponse = (
  expected: EventDocument,
  received: EventDocument,
): void => {
  checkObjects.checkEvent(expected as Required<EventInterface>, received);
  expect(received).toMatchObject({
    _id: expected._id.toString(),
  });
};

const createFakeBody = (
  body: Partial<EventInterface> = {},
): Required<EventInterface> =>
  Factory.build<Required<EventInterface>>('Event', body);

type Ents = { objects: EventDocument[] };
const createEnts = async (): Promise<Ents> => {
  const [res1, res2, res3] = await Promise.all([
    helpers.createAdminUserAndToken(),
    helpers.createAdminUserAndToken(),
    helpers.createAdminUserAndToken(),
  ]);
  res1.admin.user = res1.user;
  res2.admin.user = res2.user;
  res3.admin.user = res3.user;

  const [employee1, employee2, employee3] = await Promise.all([
    helpers.createEmployee({}),
    helpers.createEmployee({}),
    helpers.createEmployee({}),
  ]);

  const [client1, client2, client3] = await Promise.all([
    helpers.createClient({}),
    helpers.createClient({}),
    helpers.createClient({}),
  ]);

  const finish = await helpers.createFinish({});
  const product = (await helpers.createProduct({
    body: { pricesPerFinishes: [{ finish: finish._id, price: 34500 }] },
  })) as Required<ProductDocument>;
  product.pricesPerFinishes[0].finish = finish;

  const fakeOrder = Factory.build<OrderInterface>('Order');

  const item1 = {
    ...fakeOrder.items[0],
    product: product._id,
    finish: finish._id,
  };

  const populatedItem = {
    ...fakeOrder.items[0],
    product,
    finish,
  };

  const order1 = await helpers.createOrder({
    body: {
      seller: res1.admin._id,
      intermediator: employee1._id,
      client: client1._id,
      items: [item1],
    },
  });
  order1.seller = res1.admin;
  order1.intermediator = employee1;
  order1.client = client1;
  order1.items = [populatedItem];

  const order2 = await helpers.createOrder({
    body: {
      seller: res2.admin._id,
      intermediator: employee2._id,
      client: client2._id,
      items: [item1],
    },
  });
  order2.seller = res2.admin;
  order2.intermediator = employee2;
  order2.client = client2;
  order2.items = [populatedItem];

  const order3 = await helpers.createOrder({
    body: {
      seller: res3.admin._id,
      intermediator: employee3._id,
      client: client3._id,
      items: [item1],
    },
  });
  order3.seller = res3.admin;
  order3.intermediator = employee3;
  order3.client = client3;
  order3.items = [populatedItem];

  const o1 = await helpers.createEvent({
    body: {
      client: client1._id,
      order: order1._id,
      sourceEvent: undefined,
      employees: [employee1._id],
      title: 'Montagem da cuba',
      isPending: false,
    },
  });
  o1.client = client1;
  o1.order = order1;
  o1.employees = [employee1];

  const o2 = await helpers.createEvent({
    body: {
      client: client2._id,
      order: order2._id,
      sourceEvent: o1._id,
      employees: [employee2._id],
      title: 'Conserto do acabamento',
      isPending: true,
    },
  });
  o2.client = client2;
  o2.order = order2;
  o2.sourceEvent = o1;
  o2.employees = [employee2];

  const o3 = await helpers.createEvent({
    body: {
      client: client3._id,
      order: order3._id,
      sourceEvent: undefined,
      employees: [employee3._id],
      title: 'Medição do móvel',
      isPending: false,
    },
  });
  o3.client = client3;
  o3.order = order3;
  o3.employees = [employee3];

  const objects = [o1, o2, o3];

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
    createQuery({ id: fakeId, input: fakeBody as Required<UpdateEventInput> }),
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

  test('404 Event not found - no event', async () => {
    const body = createFakeBody();

    return baseRequest({ id: fakeId, input: body }, setupData.dev.token).then(
      utils.expectGqlError(err.EVENT_NOT_FOUND, resolver),
    );
  });

  let ents: Ents;
  test('404 Event not found - wrong id', async () => {
    ents = await createEnts();
    const body = createFakeBody();
    return baseRequest({ id: fakeId, input: body }, setupData.dev.token).then(
      utils.expectGqlError(err.EVENT_NOT_FOUND, resolver),
    );
  });

  /** Verificar referências */
  test('404 Event not found', async () => {
    const object = ents.objects[1];
    const id = object._id.toString();
    const employee = (object.employees as EmployeeDocument[])[0];

    const body = createFakeBody({});
    body.client = (object.client as ClientDocument)._id;
    body.order = (object.order as OrderDocument)._id;
    body.employees = [employee._id];

    return baseRequest({ id, input: body }, setupData.dev.token).then(
      utils.expectGqlError(err.EVENT_NOT_FOUND, resolver),
    );
  });

  test('404 Order not found', async () => {
    const object = ents.objects[1];
    const id = object._id.toString();
    const employee = (object.employees as EmployeeDocument[])[0];

    const body = createFakeBody({});
    body.sourceEvent = (object.sourceEvent as EventDocument)._id;
    body.client = (object.client as ClientDocument)._id;
    body.employees = [employee._id];

    return baseRequest({ id, input: body }, setupData.dev.token).then(
      utils.expectGqlError(err.ORDER_NOT_FOUND, resolver),
    );
  });

  test('404 Client not found', async () => {
    const object = ents.objects[1];
    const id = object._id.toString();
    const employee = (object.employees as EmployeeDocument[])[0];

    const body = createFakeBody({});
    body.sourceEvent = (object.sourceEvent as EventDocument)._id;
    body.order = (object.order as OrderDocument)._id;
    body.employees = [employee._id];

    return baseRequest({ id, input: body }, setupData.dev.token).then(
      utils.expectGqlError(err.CLIENT_NOT_FOUND, resolver),
    );
  });

  test('404 Employee not found', async () => {
    const object = ents.objects[1];
    const id = object._id.toString();

    const body = createFakeBody({});
    body.sourceEvent = (object.sourceEvent as EventDocument)._id;
    body.client = (object.client as ClientDocument)._id;
    body.order = (object.order as OrderDocument)._id;

    return baseRequest({ id, input: body }, setupData.dev.token).then(
      utils.expectGqlError(err.EMPLOYEE_NOT_FOUND, resolver),
    );
  });

  /** Verificar conflitos */

  test('200 Event updated', async () => {
    const object = ents.objects[1];
    const id = object._id.toString();
    const employee = (object.employees as EmployeeDocument[])[0];

    const { sourceEvent, client, order, employees } = object;
    const body = createFakeBody({});
    body.sourceEvent = (object.sourceEvent as EventDocument)._id;
    body.client = (object.client as ClientDocument)._id;
    body.order = (object.order as OrderDocument)._id;
    body.employees = [employee._id];

    return baseRequest({ id, input: body }, setupData.dev.token).then(
      response => {
        // utils.printForDocs(response.body)
        const { event, error } = response.body.data[resolver];
        expect(error).toBe(null);
        const expected = {
          ...object.toJSON(),
          ...body,
          sourceEvent,
          client,
          order,
          employees,
        };
        checkResponse(expected, event);
      },
    );
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
