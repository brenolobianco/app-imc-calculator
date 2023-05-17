import { wrapGqlAsyncFunc } from '../../middlewares/errorHandling/errorHandlingHelpers';
import validateGqlRequest from '../../middlewares/validation';
import isGqlAuthenticated from '../../middlewares/authentication';
import isGqlAuthorized from '../../middlewares/authorization';
import * as ProductHelpers from '../../helpers/ProductHelpers';
import {
  MyContext,
  CreateProductInput,
  UpdateProductInput,
  ListProductsParams,
  ListProductsResponse,
  MyObject,
  PricesPerFinishesDataLoader,
  UpdateProductPricesInput,
} from '../../types';
import {
  ProductDoc,
  ProductDocument,
  ProductPricePerFinish,
} from '../../interfaces';

function createProduct(
  _parent: unknown,
  _args: unknown,
  context: MyContext<{ input: CreateProductInput }>,
): Promise<{ product: ProductDocument }> {
  return ProductHelpers.createProduct(context.validData.input);
}

function updateProduct(
  _parent: unknown,
  _args: unknown,
  context: MyContext<{ id: string; input: UpdateProductInput }>,
): Promise<{ product: ProductDoc }> {
  return ProductHelpers.updateProduct(context.validData);
}

function deleteProduct(
  _parent: unknown,
  _args: unknown,
  context: MyContext<{ id: string }>,
): Promise<MyObject> {
  return ProductHelpers.deleteProduct(context.validData);
}

function listProducts(
  _parent: unknown,
  _args: unknown,
  context: MyContext<ListProductsParams>,
): Promise<ListProductsResponse> {
  return ProductHelpers.listProducts(context.validData);
}

function readProduct(
  _parent: unknown,
  _args: unknown,
  context: MyContext<{ id: string }>,
): Promise<{ product: ProductDoc }> {
  return ProductHelpers.readProduct(context.validData);
}

function getProductPricesPerFinishes(
  product: ProductDocument,
  _args: unknown,
  context: MyContext<unknown, PricesPerFinishesDataLoader>,
): Promise<ProductPricePerFinish[]> {
  const { loaders } = context;

  const { pricesPerFinishesLoader } = loaders;

  return pricesPerFinishesLoader.load(product);
}

function updateProductPrices(
  _parent: unknown,
  _args: unknown,
  context: MyContext<{ input: UpdateProductPricesInput }>,
): Promise<MyObject> {
  return ProductHelpers.updateProductPrices(context.validData.input);
}

export const Query = {
  listProducts: wrapGqlAsyncFunc(
    isGqlAuthenticated(isGqlAuthorized(validateGqlRequest(listProducts))),
  ),
  readProduct: wrapGqlAsyncFunc(
    isGqlAuthenticated(isGqlAuthorized(validateGqlRequest(readProduct))),
  ),
};

export const Mutation = {
  createProduct: wrapGqlAsyncFunc(
    isGqlAuthenticated(isGqlAuthorized(validateGqlRequest(createProduct))),
  ),
  updateProduct: wrapGqlAsyncFunc(
    isGqlAuthenticated(isGqlAuthorized(validateGqlRequest(updateProduct))),
  ),
  deleteProduct: wrapGqlAsyncFunc(
    isGqlAuthenticated(isGqlAuthorized(validateGqlRequest(deleteProduct))),
  ),
  updateProductPrices: wrapGqlAsyncFunc(
    isGqlAuthenticated(
      isGqlAuthorized(validateGqlRequest(updateProductPrices)),
    ),
  ),
};

export const references = {
  Product: {
    pricesPerFinishes: getProductPricesPerFinishes,
  },
};
