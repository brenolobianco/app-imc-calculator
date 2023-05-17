import { OrderDocument, OrderDoc, OrderItem } from '../../interfaces';
import isGqlAuthenticated from '../../middlewares/authentication';
import isGqlAuthorized from '../../middlewares/authorization';
import { wrapGqlAsyncFunc } from '../../middlewares/errorHandling/errorHandlingHelpers';
import validateGqlRequest from '../../middlewares/validation';
import * as OrderHelpers from '../../helpers/OrderHelpers';
import {
  MyContext,
  CreateOrderInput,
  ListOrdersParams,
  ListOrdersResponse,
  OrderItemsDataLoader,
  UpdateOrderInput,
  MyObject,
} from '../../types';

function createOrder(
  _parent: unknown,
  _args: unknown,
  context: MyContext<{ input: CreateOrderInput }>,
): Promise<{ order: OrderDocument }> {
  return OrderHelpers.createOrder(context.user, context.validData.input);
}

function listOrders(
  _parent: unknown,
  _args: unknown,
  context: MyContext<ListOrdersParams>,
): Promise<ListOrdersResponse> {
  return OrderHelpers.listOrders(context.validData);
}

function readOrder(
  _parent: unknown,
  _args: unknown,
  context: MyContext<{ id: string }>,
): Promise<{ order: OrderDoc }> {
  return OrderHelpers.readOrder(context.validData);
}

function updateOrder(
  _parent: unknown,
  _args: unknown,
  context: MyContext<{ id: string; input: UpdateOrderInput }>,
): Promise<{ order: OrderDoc }> {
  return OrderHelpers.updateOrder(context.validData);
}

function deleteOrder(
  _parent: unknown,
  _args: unknown,
  context: MyContext<{ id: string }>,
): Promise<MyObject> {
  return OrderHelpers.deleteOrder(context.validData);
}

const getOrderItems = (
  response: OrderDocument,
  _args: unknown,
  context: MyContext<unknown, OrderItemsDataLoader>,
): Promise<OrderItem[]> => {
  const { loaders } = context;

  const { orderItemsDataLoader } = loaders;

  return orderItemsDataLoader.load(response);
};

function duplicateBudget(
  _parent: unknown,
  _args: unknown,
  context: MyContext<{ id: string }>,
): Promise<{ order: OrderDocument }> {
  return OrderHelpers.duplicateBudget(context.validData);
}

export const Query = {
  listOrders: wrapGqlAsyncFunc(
    isGqlAuthenticated(isGqlAuthorized(validateGqlRequest(listOrders))),
  ),
  readOrder: wrapGqlAsyncFunc(
    isGqlAuthenticated(isGqlAuthorized(validateGqlRequest(readOrder))),
  ),
};

export const Mutation = {
  createOrder: wrapGqlAsyncFunc(
    isGqlAuthenticated(isGqlAuthorized(validateGqlRequest(createOrder))),
  ),
  updateOrder: wrapGqlAsyncFunc(
    isGqlAuthenticated(isGqlAuthorized(validateGqlRequest(updateOrder))),
  ),
  deleteOrder: wrapGqlAsyncFunc(
    isGqlAuthenticated(isGqlAuthorized(validateGqlRequest(deleteOrder))),
  ),
  duplicateBudget: wrapGqlAsyncFunc(
    isGqlAuthenticated(isGqlAuthorized(validateGqlRequest(duplicateBudget))),
  ),
};

export const references = {
  Order: {
    client: OrderHelpers.getOrderClient,
    seller: OrderHelpers.getOrderSeller,
    intermediator: OrderHelpers.getOrderIntermediator,
    items: getOrderItems,
  },
};
