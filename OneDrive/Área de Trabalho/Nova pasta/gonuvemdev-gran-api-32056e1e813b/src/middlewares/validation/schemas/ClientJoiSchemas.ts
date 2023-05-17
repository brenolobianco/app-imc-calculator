import Joi from 'joi';

import { ClientInterface } from '../../../interfaces';
import {
  JoiSchemaMap,
  CreateClientInput,
  UpdateClientInput,
  ClientFilter,
} from '../../../types';
import {
  addressKeys,
  arraySchema,
  basicStringSchema,
  cpfSchema,
  createSchema,
  digitsStringSchema,
  emailSchema,
  idSchema,
  listSchema,
  phoneSchema,
  readSchema,
  removeSchema,
  updateSchema,
} from './baseSchemas';

export const ClientSchema: JoiSchemaMap<ClientInterface> = {
  name: basicStringSchema,
  address: Joi.object(addressKeys),
  primaryPhone: phoneSchema,
  secondaryPhones: arraySchema(phoneSchema),
  email: emailSchema,
  type: basicStringSchema.valid('PF', 'PJ'),
  cpf: cpfSchema,
  cnpj: basicStringSchema.regex(/^[0-9]{14}$/),
  rg: digitsStringSchema,
  stateRegistration: basicStringSchema.regex(/^[0-9]{9}$/),
  adminWhoRegistered: idSchema,
};

const createKeys: JoiSchemaMap<CreateClientInput> = {
  name: ClientSchema.name.optional(),
  address: ClientSchema.address.optional(),
  primaryPhone: ClientSchema.primaryPhone.required(),
  secondaryPhones: ClientSchema.secondaryPhones.optional(),
  email: ClientSchema.email.optional(),
  type: ClientSchema.type.required().default('PF'),
  cpf: ClientSchema.cpf.optional(),
  cnpj: ClientSchema.cnpj.optional(),
  rg: ClientSchema.rg.optional(),
  stateRegistration: ClientSchema.stateRegistration.optional(),
};

const create = createSchema(Joi.object().keys(createKeys));

const updateKeys: JoiSchemaMap<UpdateClientInput> = {
  name: ClientSchema.name.optional(),
  address: ClientSchema.address.optional(),
  primaryPhone: ClientSchema.primaryPhone.optional(),
  secondaryPhones: ClientSchema.secondaryPhones.optional(),
  email: ClientSchema.email.optional(),
  type: ClientSchema.type.required(),
  cpf: ClientSchema.cpf.optional(),
  cnpj: ClientSchema.cnpj.optional(),
  rg: ClientSchema.rg.optional(),
  stateRegistration: ClientSchema.stateRegistration.optional(),
};
const update = updateSchema(
  Joi.object()
    .keys(updateKeys)
    .or(
      'name',
      'address',
      'primaryPhone',
      'secondaryPhones',
      'email',
      'type',
      'cpf',
      'cnpj',
      'rg',
      'stateRegistration',
    ),
);

const remove = removeSchema;

const sortFields = ['name', '-name', 'createdAt', '-createdAt'];
const defaultField = 'name';
const filters: JoiSchemaMap<ClientFilter> = {
  type: ClientSchema.type.optional(),
  adminWhoRegistered: ClientSchema.adminWhoRegistered.optional(),
};

const list = listSchema(sortFields, defaultField, filters);

const read = readSchema;

export const resolvers = {
  createClient: create,
  updateClient: update,
  deleteClient: remove,
  listClients: list,
  readClient: read,
};
