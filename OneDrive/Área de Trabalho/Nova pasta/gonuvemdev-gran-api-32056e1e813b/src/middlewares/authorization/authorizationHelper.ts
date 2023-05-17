import { GraphQLResolveInfo } from 'graphql';
import { Request, Response, NextFunction } from 'express';

import { Role } from '../../enums';
import { GqlResolver, MyContext } from '../../types';
import { USER_NOT_ALLOWED } from '../errorHandling/errors';
import { gqlRouter, restRouter } from './authorizationRouter';

export const getRoleWithTheHighestPermission = async (
  roles: Role[],
): Promise<Role> => {
  if (roles.includes(Role.Dev)) return Role.Dev;
  if (roles.includes(Role.Admin)) return Role.Admin;
  throw USER_NOT_ALLOWED;
};

export const isGqlAuthorized = (resolver: GqlResolver) => async (
  parent: unknown,
  args: unknown,
  context: MyContext,
  info: GraphQLResolveInfo,
): Promise<unknown> => {
  const rolesAllowed = gqlRouter[info.fieldName] || [];

  const canAccessRoute = (role: Role): boolean => rolesAllowed.includes(role);

  const isAuthorized = context.user.roles.some(canAccessRoute);

  if (!isAuthorized) throw USER_NOT_ALLOWED;

  return resolver(parent, args, context, info);
};

export const isAuthorized = async (
  req: Request,
  res: Response,
  next: NextFunction,
): Promise<void> => {
  const completeRequestPath = req.baseUrl + req.route.path;
  const requestMethod = req.method;
  const authorizationKey = `${requestMethod} ${completeRequestPath}`;

  const rolesAllowed = restRouter[authorizationKey] || [];

  const canAccessRoute = (role: Role): boolean => rolesAllowed.includes(role);

  const hasPermission = res.locals.user.roles.some(canAccessRoute);

  if (!hasPermission) throw USER_NOT_ALLOWED;

  next();
};
