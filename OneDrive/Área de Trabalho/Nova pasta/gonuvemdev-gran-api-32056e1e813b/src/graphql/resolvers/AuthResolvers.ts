import { wrapGqlAsyncFunc } from '../../middlewares/errorHandling/errorHandlingHelpers';
import validateGqlRequest from '../../middlewares/validation';
import isGqlAuthorized from '../../middlewares/authorization';
import { isGqlAuthenticated } from '../../middlewares/authentication/authenticationHelper';
import * as AuthResolverHelpers from '../../helpers/AuthResolverHelpers';
import {
  MyContext,
  LoginParams,
  LoginResponse,
  ValidateTokenParams,
  ForgotPasswordParams,
  RenewPasswordParams,
  UpdateOwnProfileInput,
  UpdateOwnPasswordParams,
  MyObject,
} from '../../types';
import { AdminDoc, UserDocument } from '../../interfaces';

function login(
  _parent: unknown,
  _args: unknown,
  context: MyContext<LoginParams>,
): Promise<LoginResponse> {
  return AuthResolverHelpers.login(context.validData);
}

function validateToken(
  _parent: unknown,
  _args: unknown,
  context: MyContext<ValidateTokenParams>,
): Promise<MyObject> {
  return AuthResolverHelpers.validateToken(context.validData);
}

function forgotPassword(
  _parent: unknown,
  _args: unknown,
  context: MyContext<ForgotPasswordParams>,
): Promise<MyObject> {
  return AuthResolverHelpers.forgotPassword(context.validData);
}

function renewPassword(
  _parent: unknown,
  _args: unknown,
  context: MyContext<RenewPasswordParams>,
): Promise<MyObject> {
  return AuthResolverHelpers.renewPassword(context.validData);
}

function readOwnProfile(
  _parent: unknown,
  _args: unknown,
  context: MyContext,
): Promise<{ admin: AdminDoc }> {
  return AuthResolverHelpers.readOwnProfile(context.user);
}

function updateOwnProfile(
  _parent: unknown,
  _args: unknown,
  context: MyContext<{ input: UpdateOwnProfileInput }>,
): Promise<{ admin: AdminDoc }> {
  return AuthResolverHelpers.updateOwnProfile(
    context.user,
    context.validData.input,
  );
}

function updateOwnPassword(
  _parent: unknown,
  _args: unknown,
  context: MyContext<UpdateOwnPasswordParams>,
): Promise<{ user: UserDocument }> {
  return AuthResolverHelpers.updateOwnPassword(context.user, context.validData);
}

export const Query = {
  readOwnProfile: wrapGqlAsyncFunc(
    isGqlAuthenticated(isGqlAuthorized(readOwnProfile)),
  ),
};

export const Mutation = {
  login: wrapGqlAsyncFunc(validateGqlRequest(login)),
  validateToken: wrapGqlAsyncFunc(validateGqlRequest(validateToken)),
  forgotPassword: wrapGqlAsyncFunc(validateGqlRequest(forgotPassword)),
  renewPassword: wrapGqlAsyncFunc(validateGqlRequest(renewPassword)),
  updateOwnProfile: wrapGqlAsyncFunc(
    isGqlAuthenticated(isGqlAuthorized(validateGqlRequest(updateOwnProfile))),
  ),
  updateOwnPassword: wrapGqlAsyncFunc(
    isGqlAuthenticated(validateGqlRequest(updateOwnPassword)),
  ),
};
