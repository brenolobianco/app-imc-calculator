// eslint-disable-next-line import/no-extraneous-dependencies
import { Factory } from 'rosie';

import {
  AdminInterface,
  ClientInterface,
  EmployeeInterface,
  EventInterface,
  FinishInterface,
  OrderInterface,
  ProductInterface,
  UserInterface,
} from './interfaces';

import {
  fakeAdmin,
  fakeClient,
  fakeEmployee,
  fakeEvent,
  fakeFinish,
  fakeOrder,
  fakeProduct,
  fakeUser,
} from './fakers';

Factory.define<AdminInterface>('Admin').attrs(fakeAdmin);

Factory.define<UserInterface>('User').attrs(fakeUser);

Factory.define<EmployeeInterface>('Employee').attrs(fakeEmployee);

Factory.define<FinishInterface>('Finish').attrs(fakeFinish);

Factory.define<ProductInterface>('Product').attrs(fakeProduct);

Factory.define<ClientInterface>('Client').attrs(fakeClient);

Factory.define<OrderInterface>('Order').attrs(fakeOrder);

Factory.define<EventInterface>('Event').attrs(fakeEvent);

export default Factory;
