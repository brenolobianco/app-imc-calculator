import { wrapGqlAsyncFunc } from '../../middlewares/errorHandling/errorHandlingHelpers';
import validateGqlRequest from '../../middlewares/validation';
import isGqlAuthenticated from '../../middlewares/authentication';
import isGqlAuthorized from '../../middlewares/authorization';
import * as AdminResolverHelpers from '../../helpers/AdminResolverHelpers';
import {
  MyContext,
  CreateAdminInput,
  UpdateAdminInput,
  ListAdminsParams,
  ListAdminsResponse,
  MyObject,
} from '../../types';
import { AdminDoc, AdminDocument } from '../../interfaces';

function createAdmin(
  _parent: unknown,
  _args: unknown,
  context: MyContext<{ input: CreateAdminInput }>,
): Promise<{ admin: AdminDocument }> {
  return AdminResolverHelpers.createAdmin(context.validData.input);
}

function updateAdmin(
  _parent: unknown,
  _args: unknown,
  context: MyContext<{ id: string; input: UpdateAdminInput }>,
): Promise<{ admin: AdminDoc }> {
  return AdminResolverHelpers.updateAdmin(context.validData);
}

function deleteAdmin(
  _parent: unknown,
  _args: unknown,
  context: MyContext<{ id: string }>,
): Promise<MyObject> {
  return AdminResolverHelpers.deleteAdmin(context.validData);
}

function listAdmins(
  _parent: unknown,
  _args: unknown,
  context: MyContext<ListAdminsParams>,
): Promise<ListAdminsResponse> {
  return AdminResolverHelpers.listAdmins(context.validData);
}

function readAdmin(
  _parent: unknown,
  _args: unknown,
  context: MyContext<{ id: string }>,
): Promise<{ admin: AdminDoc }> {
  return AdminResolverHelpers.readAdmin(context.validData);
}

export const Query = {
  listAdmins: wrapGqlAsyncFunc(
    isGqlAuthenticated(isGqlAuthorized(validateGqlRequest(listAdmins))),
  ),
  readAdmin: wrapGqlAsyncFunc(
    isGqlAuthenticated(isGqlAuthorized(validateGqlRequest(readAdmin))),
  ),
};

export const Mutation = {
  createAdmin: wrapGqlAsyncFunc(
    isGqlAuthenticated(isGqlAuthorized(validateGqlRequest(createAdmin))),
  ),
  updateAdmin: wrapGqlAsyncFunc(
    isGqlAuthenticated(isGqlAuthorized(validateGqlRequest(updateAdmin))),
  ),
  deleteAdmin: wrapGqlAsyncFunc(
    isGqlAuthenticated(isGqlAuthorized(validateGqlRequest(deleteAdmin))),
  ),
};

export const references = {
  Admin: {
    user: AdminResolverHelpers.getAdminUser,
    employee: AdminResolverHelpers.getAdminEmployee,
  },
};
