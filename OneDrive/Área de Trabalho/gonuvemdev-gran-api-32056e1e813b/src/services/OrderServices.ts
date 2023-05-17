import Order from '../models/Order';
import {
  createOne,
  listPaginated,
  fetchOne,
  updateOne,
  deleteOne,
  fetchAll,
  checkIfExists,
  fetchOneWithoutError,
  countByCriteria,
} from '../utils/mongoose';
import {
  ORDERS_EMPTY_LIST,
  ORDER_NOT_FOUND,
} from '../middlewares/errorHandling/errors';

export const createOneOrder = createOne(Order);

export const listOrdersPaginated = listPaginated(Order, ORDERS_EMPTY_LIST);

export const fetchOneOrder = fetchOne(Order, ORDER_NOT_FOUND);

export const updateOneOrder = updateOne(Order, ORDER_NOT_FOUND);

export const deleteOneOrder = deleteOne(Order, ORDER_NOT_FOUND);

export const fetchAllOrders = fetchAll(Order);

export const checkIfOrdersExists = checkIfExists(Order, ORDER_NOT_FOUND);

export const fetchOneOrderWithoutError = fetchOneWithoutError(Order);

export const countOrdersByCriteria = countByCriteria(Order);
