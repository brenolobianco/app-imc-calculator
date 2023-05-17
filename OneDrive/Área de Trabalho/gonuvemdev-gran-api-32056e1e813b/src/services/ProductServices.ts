import Product from '../models/Product';
import {
  createOne,
  fetchOne,
  updateOne,
  deleteOne,
  listPaginated,
  fetchAll,
  bulkWrite,
  fetchOneWithoutError,
  checkIfExists,
  checkInUse,
  countTotal,
} from '../utils/mongoose';
import {
  PRODUCTS_EMPTY_LIST,
  PRODUCT_IN_USE,
  PRODUCT_NOT_FOUND,
} from '../middlewares/errorHandling/errors';
import Order from '../models/Order';

export const createOneProduct = createOne(Product);

export const listProductsPaginated = listPaginated(
  Product,
  PRODUCTS_EMPTY_LIST,
);

export const fetchOneProduct = fetchOne(Product, PRODUCT_NOT_FOUND);

export const updateOneProduct = updateOne(Product, PRODUCT_NOT_FOUND);

export const deleteOneProduct = deleteOne(Product, PRODUCT_NOT_FOUND);

export const fetchAllProducts = fetchAll(Product);

export const bulkWriteProducts = bulkWrite(Product);

export const fetchOneProductWithoutError = fetchOneWithoutError(Product);

export const checkIfProductsExists = checkIfExists(Product, PRODUCT_NOT_FOUND);

export const checkProductInUse = checkInUse(
  [{ Model: Order, fieldName: 'items.product' }],
  PRODUCT_IN_USE,
);

export const countProductsTotal = countTotal(Product);
