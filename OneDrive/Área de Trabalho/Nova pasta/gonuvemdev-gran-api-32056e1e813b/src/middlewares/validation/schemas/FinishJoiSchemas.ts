import Joi from 'joi';

import {
  createSchema,
  updateSchema,
  removeSchema,
  listSchema,
  readSchema,
  basicStringSchema,
  integerSchema,
  urlSchema,
} from './baseSchemas';
import {
  JoiSchemaMap,
  CreateFinishInput,
  UpdateFinishInput,
} from '../../../types';
import { FinishInterface } from '../../../interfaces';

export const FinishSchema: JoiSchemaMap<Required<FinishInterface>> = {
  code: basicStringSchema,
  value: integerSchema.min(100),
  design: urlSchema,
  thickeningInDepth: integerSchema.min(0),
  thickeningInLength: integerSchema.min(0),
};

const createKeys: JoiSchemaMap<Required<CreateFinishInput>> = {
  code: FinishSchema.code.required(),
  value: FinishSchema.value.required(),
  design: FinishSchema.design.optional(),
  thickeningInDepth: FinishSchema.thickeningInDepth.required(),
  thickeningInLength: FinishSchema.thickeningInLength.required(),
};

const create = createSchema(Joi.object().keys(createKeys));

const updateKeys: JoiSchemaMap<Required<UpdateFinishInput>> = {
  code: FinishSchema.code.optional(),
  value: FinishSchema.value.optional(),
  design: FinishSchema.design.optional(),
  thickeningInDepth: FinishSchema.thickeningInDepth.optional(),
  thickeningInLength: FinishSchema.thickeningInLength.optional(),
};
const update = updateSchema(
  Joi.object()
    .keys(updateKeys)
    .or('code', 'value', 'design', 'thickeningInDepth', 'thickeningInLength'),
);

const remove = removeSchema;

const sortFields = ['-code', 'code', '-createdAt', 'createdAt'];
const defaultField = 'code';
const filters = {};

const list = listSchema(sortFields, defaultField, filters);

const read = readSchema;

export const resolvers = {
  createFinish: create,
  updateFinish: update,
  deleteFinish: remove,
  listFinishes: list,
  readFinish: read,
};
