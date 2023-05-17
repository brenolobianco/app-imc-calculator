/* eslint-disable max-lines */
/* eslint-disable @typescript-eslint/explicit-module-boundary-types */
/* eslint-disable func-names */
/* eslint-disable max-lines-per-function */
import mongoose, {
  Query,
  Document,
  QueryPopulateOptions,
  CreateQuery,
  SchemaDefinition,
} from 'mongoose';
import { Boom } from '@hapi/boom';
// eslint-disable-next-line import/no-extraneous-dependencies
import { BulkWriteOpResultObject } from 'mongodb';

import {
  FetchParams,
  UpdateParams,
  ListPaginatedParams,
  BaseListResult,
  Address,
} from '../interfaces';
import { ID, MongooseDefinition } from '../types';
import { isEmptyArray } from './general';

export function fetchOne<T extends Document>(
  Model: mongoose.Model<T>,
  notFoundError: Boom,
) {
  return function ({
    conditions = {},
    projection = '',
    lean = true,
  }: FetchParams) {
    return Model.findOne(conditions, projection)
      .lean(lean)
      .orFail(notFoundError);
  };
}

export function createOne<T extends Document>(Model: mongoose.Model<T>) {
  return async function ({ doc }: { doc: Partial<T> }): Promise<T> {
    const obj = new Model(doc);

    return obj.save();
  };
}

export function createMany<T extends Document>(Model: mongoose.Model<T>) {
  return async function ({ docs }: { docs: CreateQuery<T> }) {
    return Model.create(docs);
  };
}

export function createOneObject<T extends Document>(Model: mongoose.Model<T>) {
  return function ({ doc }: { doc: unknown }): T {
    return new Model(doc);
  };
}

export function updateOne<T extends Document>(
  Model: mongoose.Model<T>,
  notFoundError: Boom,
) {
  return function ({ conditions, updateData }: UpdateParams) {
    return Model.findOneAndUpdate(conditions, updateData, { new: true })
      .lean()
      .orFail(notFoundError);
  };
}

export function deleteOne<T extends Document>(
  Model: mongoose.Model<T>,
  notFoundError: Boom,
) {
  return function ({ conditions }: { conditions: any }) {
    return Model.findOneAndDelete(conditions).orFail(notFoundError).lean();
  };
}

export function countByCriteria<T extends Document>(Model: mongoose.Model<T>) {
  return function ({ criteria }: { criteria: any }) {
    return Model.countDocuments(criteria);
  };
}

export function countTotal<T extends Document>(Model: mongoose.Model<T>) {
  return function () {
    return Model.estimatedDocumentCount();
  };
}

type CountInfo = { Model: mongoose.Model<Document>; fieldName: string };

export function checkInUse(countInfo: CountInfo[], inUseError: Boom) {
  return async function ({ id }: { id: string }): Promise<void> {
    const countsPromises = countInfo.map(({ Model, fieldName }) => {
      return countByCriteria(Model)({ criteria: { [fieldName]: id } });
    });

    const countsResults = await Promise.all(countsPromises);

    const total = countsResults.reduce((sum, count) => sum + count, 0);

    if (total > 0) throw inUseError;
  };
}

type Populate = string | QueryPopulateOptions | QueryPopulateOptions[];

export function fetchOneWithPopulate<T extends Document>(
  Model: mongoose.Model<T>,
  notFoundError: Boom,
  paths: Populate,
) {
  return function ({
    conditions = {},
    projection = '',
    lean = true,
  }: FetchParams) {
    return Model.findOne(conditions, projection)
      .populate(paths)
      .orFail(notFoundError)
      .lean(lean);
  };
}

export function listPaginatedWithPopulate<T extends Document>(
  Model: mongoose.Model<T>,
  emptyArrayError: Boom,
  paths: Populate,
) {
  return async function ({
    conditions = {},
    projection = '',
    sort = '',
    page = 0,
    perPage = 5,
  }: ListPaginatedParams): Promise<BaseListResult<T>> {
    const [total, objects] = await Promise.all<number, T[]>([
      Model.find(conditions, projection).lean().countDocuments(),
      Model.find(conditions, projection)
        .sort(sort)
        .skip(page * perPage)
        .limit(perPage)
        .populate(paths)
        .lean(),
    ]);

    if (isEmptyArray(objects)) throw emptyArrayError;

    const pages = Math.ceil(total / perPage);

    return { objects, total, pages };
  };
}

export function listPaginated<T extends Document>(
  Model: mongoose.Model<T>,
  emptyArrayError: Boom,
) {
  return async function ({
    conditions = {},
    projection = '',
    sort = '',
    page = 0,
    perPage = 5,
  }: ListPaginatedParams): Promise<BaseListResult<T>> {
    const [total, objects] = await Promise.all<number, T[]>([
      Model.find(conditions, projection).lean().countDocuments(),
      Model.find(conditions, projection)
        .sort(sort)
        .skip(page * perPage)
        .limit(perPage)
        .lean(),
    ]);

    if (isEmptyArray(objects)) throw emptyArrayError;

    const pages = Math.ceil(total / perPage);

    return { objects, total, pages };
  };
}

export function fetchOneWithoutError<T extends Document>(
  Model: mongoose.Model<T>,
) {
  return function ({
    conditions = {},
    projection = '',
    lean = true,
  }: FetchParams) {
    return Model.findOne(conditions, projection).lean(lean);
  };
}

export function fetchAll<T extends Document>(Model: mongoose.Model<T>) {
  return function ({
    conditions = {},
    projection = '',
    sort = '',
    lean = true,
  }: FetchParams): Query<Array<T>> {
    return Model.find(conditions, projection).sort(sort).lean(lean);
  };
}

type ConflictFieldAndError<T> = {
  fieldName: keyof T;
  error: Boom;
};
export function checkConflicts<T extends Document>(
  Model: mongoose.Model<T>,
  fieldsAndErrors: ConflictFieldAndError<T>[],
) {
  return async function (doc: Partial<T>, excludeId?: ID): Promise<void> {
    const excludeQuery = excludeId ? { _id: { $ne: excludeId } } : {};

    const promises = fieldsAndErrors.map(({ fieldName }) => {
      return fetchOneWithoutError(Model)({
        conditions: { [fieldName]: doc[fieldName], ...excludeQuery },
      });
    });

    const results = await Promise.all(promises);

    results.forEach((conflictFound, i) => {
      if (conflictFound) throw fieldsAndErrors[i].error;
    });
  };
}

export function checkIfExists<T extends Document>(
  Model: mongoose.Model<T>,
  notFoundError: Boom,
) {
  return async function (ids: ID[]): Promise<void> {
    const uniqueIds = [...new Set(ids)];

    const total = await countByCriteria(Model)({
      criteria: { _id: { $in: uniqueIds } },
    });

    if (total !== uniqueIds.length) throw notFoundError;
  };
}

export function bulkWrite<T extends Document>(Model: mongoose.Model<T>) {
  return async function (writes: unknown[]): Promise<BulkWriteOpResultObject> {
    return Model.bulkWrite(writes);
  };
}

type LookupObject = {
  from: string;
  localField: string;
  foreignField: string;
  as: string;
};
export const createLookupObj = (
  collection: string,
  localField: string,
  fK = '_id',
): LookupObject => {
  return {
    from: collection,
    localField,
    foreignField: fK,
    as: localField,
  };
};

const addressDefinition: MongooseDefinition<Address> = {
  street: String,
  number: String,
  district: String,
  city: String,
  state: String,
  postalCode: String,
  complement: String,
};

export const AddressSchema = new mongoose.Schema(
  addressDefinition as SchemaDefinition,
  { _id: false },
);
