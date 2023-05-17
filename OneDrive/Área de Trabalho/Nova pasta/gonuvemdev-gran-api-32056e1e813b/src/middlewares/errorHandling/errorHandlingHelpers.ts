import { Boom, isBoom } from '@hapi/boom';
import { Request, Response, NextFunction } from 'express';
import { GraphQLResolveInfo } from 'graphql';

import { IS_PRODUCTION } from '../../utils/constants';
import Sentry from './sentry';
import {
  ExpressHandler,
  GqlResolver,
  MyContext,
  MyError,
  MyObject,
} from '../../types';
import { UNDEFINED } from './errors';

export const createErrorResponse = (err: Boom | Error): MyError => {
  const error = isBoom(err) ? err : UNDEFINED;

  return {
    ...error.output.payload,
    ...error.data,
    internalError: IS_PRODUCTION ? null : err,
  };
};

export const handleError = (
  err: Boom | Error,
  _req: Request,
  res: Response,
  // eslint-disable-next-line @typescript-eslint/no-unused-vars
  _next: NextFunction,
): Response => {
  const error = isBoom(err) ? err : UNDEFINED;

  const myError = createErrorResponse(err);

  return res.status(error.output.statusCode).json(myError);
};

// eslint-disable-next-line max-lines-per-function
const createSentryScopeForUnexpectedError = (
  error: Boom | Error,
  parent: unknown,
  args: unknown,
  context: MyContext,
  info: GraphQLResolveInfo,
) => (scope: Sentry.Scope): void => {
  scope.addEventProcessor(event =>
    Sentry.Handlers.parseRequest(event, context.req),
  );
  const { user } = context;
  if (user) {
    scope.setUser({
      email: user.email,
      id: user._id as string,
      ip_address: context.req.ip,
      username: user.name,
    });
  }

  scope.setTags({ graphql: info.fieldName, graphqlName: info.fieldName });

  Sentry.captureException(error);
};

const isUnexpectedError = (error: Boom | Error): boolean => {
  return (isBoom(error) && error.output.statusCode >= 500) || !isBoom(error);
};

const createGqlErrorResponse = (
  parent: unknown,
  args: unknown,
  context: MyContext,
  info: GraphQLResolveInfo,
) => (error: Boom | Error): { error: unknown } => {
  if (isUnexpectedError(error)) {
    Sentry.withScope(
      createSentryScopeForUnexpectedError(error, parent, args, context, info),
    );
  }

  return { error: createErrorResponse(error) };
};

export const wrapGqlAsyncFunc = (asyncFunction: GqlResolver) => (
  parent: MyObject,
  args: MyObject,
  context: MyContext,
  info: GraphQLResolveInfo,
): unknown => {
  return asyncFunction(parent, args, context, info).catch(
    createGqlErrorResponse(parent, args, context, info),
  );
};

export const wrapAsync = (asyncFunction: ExpressHandler) => {
  return (req: Request, res: Response, next: NextFunction): void => {
    asyncFunction(req, res, next).catch(next);
  };
};
