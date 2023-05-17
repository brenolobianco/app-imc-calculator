import Joi from 'joi';

import {
  createSchema,
  updateSchema,
  removeSchema,
  listSchema,
  readSchema,
  idSchema,
} from './baseSchemas';
import { User } from './UserJoiSchemas';
import {
  JoiSchemaMap,
  CreateAdminInput,
  UpdateAdminInput,
} from '../../../types';
import { AdminInterface } from '../../../interfaces';

const AdminSchema: JoiSchemaMap<AdminInterface> = {
  user: idSchema,
  employee: idSchema,
};

const createKeys: JoiSchemaMap<CreateAdminInput> = {
  name: User.name.required(),
  password: User.password.required(),
  email: User.email.required(),
  roles: User.roles.required(),
  employee: AdminSchema.employee.optional(),
};
const create = createSchema(Joi.object().keys(createKeys));

const updateKeys: JoiSchemaMap<UpdateAdminInput> = {
  name: User.name.optional(),
  email: User.email.optional(),
  roles: User.roles.optional(),
  employee: AdminSchema.employee.optional(),
};
const update = updateSchema(
  Joi.object().keys(updateKeys).or('name', 'email', 'roles', 'employee'),
);

const remove = removeSchema;

const sortFields = ['-user.name', 'user.name', '-createdAt', 'createdAt'];
const defaultField = 'user.name';
const filters = {};

const list = listSchema(sortFields, defaultField, filters);

const read = readSchema;

export const resolvers = {
  createAdmin: create,
  updateAdmin: update,
  deleteAdmin: remove,
  listAdmins: list,
  readAdmin: read,
};
