import Admin from '../models/Admin';
import {
  createOne,
  createOneObject,
  fetchOne,
  updateOne,
  deleteOne,
  createLookupObj,
  fetchOneWithoutError,
  checkInUse,
  countTotal,
  fetchAll,
} from '../utils/mongoose';
import {
  ADMINS_EMPTY_LIST,
  ADMIN_NOT_FOUND,
  ADMIN_IN_USE,
} from '../middlewares/errorHandling/errors';
import { isEmptyArray } from '../utils/general';
import { BaseListResult, AdminDocument } from '../interfaces';
import { MyObject } from '../types';
import Client from '../models/Client';
import Order from '../models/Order';

export const createOneAdmin = createOne(Admin);

export const createOneAdminObject = createOneObject(Admin);

export const fetchOneAdmin = fetchOne(Admin, ADMIN_NOT_FOUND);

export const updateOneAdmin = updateOne(Admin, ADMIN_NOT_FOUND);

export const deleteOneAdmin = deleteOne(Admin, ADMIN_NOT_FOUND);

export const fetchOneAdminWithoutError = fetchOneWithoutError(Admin);

// eslint-disable-next-line max-lines-per-function
export const listAdminsWithUserPaginated = async (
  conditions: MyObject,
  projection: string,
  sort: string,
  page: number,
  perPage: number,
): Promise<BaseListResult<AdminDocument>> => {
  const aggregation = Admin.aggregate()
    .match(conditions)
    .lookup(createLookupObj('users', 'user'))
    .unwind('user');

  const [count, objects] = await Promise.all([
    Admin.aggregate(aggregation.pipeline()).count('total'),
    aggregation
      .sort(sort)
      .skip(page * perPage)
      .limit(perPage),
  ]);

  if (isEmptyArray(objects)) throw ADMINS_EMPTY_LIST;

  const total = (count[0] && count[0].total) || 0;

  const pages = Math.ceil(total / perPage);

  return { objects, total, pages };
};

export const checkAdminInUse = checkInUse(
  [
    { Model: Client, fieldName: 'adminWhoRegistered' },
    { Model: Order, fieldName: 'seller' },
  ],
  ADMIN_IN_USE,
);

export const countAdminsTotal = countTotal(Admin);

export const fetchAllAdmins = fetchAll(Admin);
