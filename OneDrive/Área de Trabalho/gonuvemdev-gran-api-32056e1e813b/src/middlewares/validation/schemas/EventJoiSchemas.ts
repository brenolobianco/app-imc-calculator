import Joi from 'joi';

import { EventInterface } from '../../../interfaces';
import {
  JoiSchemaMap,
  CreateEventInput,
  UpdateEventInput,
  EventFilter,
} from '../../../types';
import {
  arraySchema,
  basicStringSchema,
  booleanSchema,
  createSchema,
  dateIntervalSchema,
  dateSchema,
  hexColorSchema,
  idSchema,
  integerSchema,
  listSchema,
  readSchema,
  removeSchema,
  updateSchema,
} from './baseSchemas';

export const EventSchema: JoiSchemaMap<EventInterface> = {
  title: basicStringSchema,
  beginDate: dateSchema,
  endDate: dateSchema,
  duration: integerSchema.min(0),
  isPending: booleanSchema,
  sourceEvent: idSchema,
  order: idSchema,
  client: idSchema,
  employees: arraySchema(idSchema.required()),
  color: hexColorSchema,
};

const createKeys: JoiSchemaMap<CreateEventInput> = {
  title: EventSchema.title.required(),
  beginDate: EventSchema.beginDate.required(),
  endDate: EventSchema.endDate.optional(),
  duration: EventSchema.duration.optional(),
  isPending: EventSchema.isPending.optional().default(false),
  sourceEvent: EventSchema.sourceEvent.optional(),
  order: EventSchema.order.optional(),
  client: EventSchema.client.optional(),
  employees: EventSchema.employees.optional(),
  color: EventSchema.color.optional().default('#f4652d'),
};

const create = createSchema(Joi.object().keys(createKeys));

const updateKeys: JoiSchemaMap<UpdateEventInput> = {
  title: EventSchema.title.optional(),
  beginDate: EventSchema.beginDate.optional(),
  endDate: EventSchema.endDate.optional(),
  duration: EventSchema.duration.optional(),
  isPending: EventSchema.isPending.optional(),
  sourceEvent: EventSchema.sourceEvent.optional(),
  order: EventSchema.order.optional(),
  client: EventSchema.client.optional(),
  employees: EventSchema.employees.optional(),
  color: EventSchema.color.optional(),
};
const update = updateSchema(
  Joi.object()
    .keys(updateKeys)
    .or(
      'title',
      'beginDate',
      'endDate',
      'duration',
      'isPending',
      'sourceEvent',
      'order',
      'client',
      'employees',
    ),
);

const remove = removeSchema;

const sortFields = ['beginDate', '-beginDate'];
const defaultField = 'beginDate';
const filters: JoiSchemaMap<EventFilter> = {
  dateInterval: dateIntervalSchema.optional(),
  isPending: EventSchema.isPending.optional(),
  order: EventSchema.order.optional(),
  client: EventSchema.client.optional(),
  employee: idSchema.optional(),
};

const list = listSchema(sortFields, defaultField, filters);

const read = readSchema;

export const resolvers = {
  createEvent: create,
  updateEvent: update,
  deleteEvent: remove,
  listEvents: list,
  readEvent: read,
};
