import Finish from '../models/Finish';
import {
  createOne,
  fetchOne,
  updateOne,
  deleteOne,
  listPaginated,
  checkConflicts,
  checkIfExists,
  fetchAll,
  checkInUse,
  fetchOneWithoutError,
  countTotal,
} from '../utils/mongoose';
import {
  FINISHES_EMPTY_LIST,
  FINISH_CODE_CONFLICT,
  FINISH_NOT_FOUND,
  FINISH_IN_USE,
} from '../middlewares/errorHandling/errors';
import Product from '../models/Product';
import Order from '../models/Order';

export const createOneFinish = createOne(Finish);

export const listFinishesPaginated = listPaginated(Finish, FINISHES_EMPTY_LIST);

export const fetchOneFinish = fetchOne(Finish, FINISH_NOT_FOUND);

export const updateOneFinish = updateOne(Finish, FINISH_NOT_FOUND);

export const deleteOneFinish = deleteOne(Finish, FINISH_NOT_FOUND);

export const checkFinishConflicts = checkConflicts(Finish, [
  {
    fieldName: 'code',
    error: FINISH_CODE_CONFLICT,
  },
]);

export const checkIfFinishesExists = checkIfExists(Finish, FINISH_NOT_FOUND);

export const fetchAllFinishes = fetchAll(Finish);

export const checkFinishInUse = checkInUse(
  [
    { Model: Product, fieldName: 'pricesPerFinishes.finish' },
    { Model: Order, fieldName: 'items.finish' },
  ],
  FINISH_IN_USE,
);

export const fetchOneFinishWithoutError = fetchOneWithoutError(Finish);

export const countFinishesTotal = countTotal(Finish);
