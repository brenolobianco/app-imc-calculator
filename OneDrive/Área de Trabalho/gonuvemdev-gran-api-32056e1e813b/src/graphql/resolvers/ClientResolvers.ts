import { ClientDocument, ClientDoc, OrderDocument } from '../../interfaces';
import isGqlAuthenticated from '../../middlewares/authentication';
import isGqlAuthorized from '../../middlewares/authorization';
import { wrapGqlAsyncFunc } from '../../middlewares/errorHandling/errorHandlingHelpers';
import validateGqlRequest from '../../middlewares/validation';
import * as ClientHelpers from '../../helpers/ClientHelpers';
import {
  MyContext,
  CreateClientInput,
  UpdateClientInput,
  MyObject,
  ListClientsParams,
  ListClientsResponse,
  ClientOrdersDataLoader,
} from '../../types';

function createClient(
  _parent: unknown,
  _args: unknown,
  context: MyContext<{ input: CreateClientInput }>,
): Promise<{ client: ClientDocument }> {
  return ClientHelpers.createClient(context.user, context.validData.input);
}

function updateClient(
  _parent: unknown,
  _args: unknown,
  context: MyContext<{ id: string; input: UpdateClientInput }>,
): Promise<{ client: ClientDoc }> {
  return ClientHelpers.updateClient(context.validData);
}

function deleteClient(
  _parent: unknown,
  _args: unknown,
  context: MyContext<{ id: string }>,
): Promise<MyObject> {
  return ClientHelpers.deleteClient(context.validData);
}

function listClients(
  _parent: unknown,
  _args: unknown,
  context: MyContext<ListClientsParams>,
): Promise<ListClientsResponse> {
  return ClientHelpers.listClients(context.validData);
}

function readClient(
  _parent: unknown,
  _args: unknown,
  context: MyContext<{ id: string }>,
): Promise<{ client: ClientDoc }> {
  return ClientHelpers.readClient(context.validData);
}

function getClientOrders(
  response: ClientDocument,
  _args: unknown,
  context: MyContext<unknown, ClientOrdersDataLoader>,
): Promise<OrderDocument[]> {
  const { loaders } = context;

  const { clientOrdersDataLoader } = loaders;

  return clientOrdersDataLoader.load(response);
}

export const Query = {
  listClients: wrapGqlAsyncFunc(
    isGqlAuthenticated(isGqlAuthorized(validateGqlRequest(listClients))),
  ),
  readClient: wrapGqlAsyncFunc(
    isGqlAuthenticated(isGqlAuthorized(validateGqlRequest(readClient))),
  ),
};

export const Mutation = {
  createClient: wrapGqlAsyncFunc(
    isGqlAuthenticated(isGqlAuthorized(validateGqlRequest(createClient))),
  ),
  updateClient: wrapGqlAsyncFunc(
    isGqlAuthenticated(isGqlAuthorized(validateGqlRequest(updateClient))),
  ),
  deleteClient: wrapGqlAsyncFunc(
    isGqlAuthenticated(isGqlAuthorized(validateGqlRequest(deleteClient))),
  ),
};

export const references = {
  Client: {
    adminWhoRegistered: ClientHelpers.getClientAdminWhoRegistered,
    orders: getClientOrders,
  },
};
