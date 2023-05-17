import mongoose, { Document } from 'mongoose';

import Factory from '../factories';
import * as jwt from '../middlewares/authentication/jwt';
import User from '../models/User';
import Admin from '../models/Admin';
import Employee from '../models/Employee';
import Finish from '../models/Finish';
import Product from '../models/Product';
import Client from '../models/Client';
import Order from '../models/Order';
import Event from '../models/Event';
import { Role } from '../enums';
import {
  UserDocument,
  AdminDocument,
  UserInterface,
  EmployeeDocument,
  FinishDocument,
  ProductDocument,
  ClientDocument,
  OrderDocument,
  EventDocument,
} from '../interfaces';

// eslint-disable-next-line max-lines-per-function
function mapModelNameToModel(modelName: string): mongoose.Model<any> {
  switch (modelName) {
    case 'User':
      return User;
    case 'Admin':
      return Admin;
    case 'Employee':
      return Employee;
    case 'Finish':
      return Finish;
    case 'Product':
      return Product;
    case 'Client':
      return Client;
    case 'Order':
      return Order;
    case 'Event':
      return Event;
    default:
      return User;
  }
}

export function buildFactories<T>(
  name: string,
  body: Partial<T>,
  size = 1,
): any {
  return size > 1
    ? Factory.buildList(name, size, body)
    : Factory.build<T>(name, body);
}

export function createObject<T extends Document>({
  modelName,
}: {
  modelName: string;
}) {
  return ({
    body = {},
    size = 1,
  }: {
    body?: Partial<T>;
    size?: number;
  }): Promise<T> => {
    const Model: mongoose.Model<T> = mapModelNameToModel(modelName);

    return Model.create(buildFactories<T>(modelName, body, size));
  };
}

export async function dropCollection({
  modelName,
}: {
  modelName: string;
}): Promise<void> {
  const Model = mapModelNameToModel(modelName);

  await Model.deleteMany({});
}

export const dropCollections = async (modelsNames: string[]): Promise<void> => {
  modelsNames.forEach(async modelName => {
    await dropCollection({ modelName });
  });
};

export const getToken = (user: UserDocument): Promise<string> => {
  return jwt.sign({ _id: user._id });
};

type RolesSplitted = {
  rolesAllowed: Array<Role>;
  rolesNotAllowed: Array<string>;
};

export const splitRolesByPermission = (
  rolesAllowed: Array<Role>,
): RolesSplitted => {
  const xrolesNotAllowed = Object.values(Role).filter(
    role => !rolesAllowed.includes(role),
  );

  const rolesNotAllowed = [...xrolesNotAllowed, 'noRole'];

  return { rolesAllowed, rolesNotAllowed };
};

/**
 * Create Models
 */

export const createUser = createObject<UserDocument>({ modelName: 'User' });

export const createAdmin = createObject<AdminDocument>({
  modelName: 'Admin',
});

export const createEmployee = createObject<EmployeeDocument>({
  modelName: 'Employee',
});

export const createFinish = createObject<FinishDocument>({
  modelName: 'Finish',
});

export const createProduct = createObject<ProductDocument>({
  modelName: 'Product',
});

export const createClient = createObject<ClientDocument>({
  modelName: 'Client',
});

export const createOrder = createObject<OrderDocument>({
  modelName: 'Order',
});

export const createEvent = createObject<EventDocument>({
  modelName: 'Event',
});

export const createAdminUserAndToken = async (
  userBody = {},
  adminBody = {},
): Promise<{ user: UserDocument; token: string; admin: AdminDocument }> => {
  const user = await createUser({
    body: { ...userBody, roles: [Role.Admin] },
  });

  const [token, admin] = await Promise.all([
    getToken(user),
    createAdmin({ body: { ...adminBody, user: user._id } }),
  ]);

  return { user, token, admin };
};

type SetupData = {
  fact: UserInterface;
  token: string;
  user: UserDocument;
};

export type SetupTaskResult = { [role in Role]: SetupData } & {
  [s: string]: SetupData;
};

const createSetupData = (
  factory: UserInterface,
  token: string,
  user: UserDocument,
): SetupData => {
  return { fact: factory, token, user };
};

export const setupTask = async (): Promise<SetupTaskResult> => {
  const roles = [[], [Role.Dev], [Role.Admin]];
  const createUserFact = (body: Partial<UserInterface>): UserInterface =>
    Factory.build<UserInterface>('User', body);

  const factories = roles.map(role => createUserFact({ roles: role }));

  const users = await Promise.all(
    factories.map(async fact => createUser({ body: fact })),
  );

  const tokens = await Promise.all(users.map(getToken));

  return {
    noRole: createSetupData(factories[0], tokens[0], users[0]),
    [Role.Dev]: createSetupData(factories[1], tokens[1], users[1]),
    [Role.Admin]: createSetupData(factories[2], tokens[2], users[2]),
  };
};
