import { Schema } from 'joi';
import { GraphQLResolveInfo } from 'graphql';
import { Request, Response, NextFunction } from 'express';

import { gqlRouter, restRouter } from './schemasRouter';
import { GqlResolver, MyContext, MyObject } from '../../types';
import { VALIDATION_ERROR } from '../errorHandling/errors';

/** Opções do Joi de validação */
const _validationOptions = {
  /** Não abortar após o último erro de validação */
  abortEarly: false,
  /** Permitir chaves desconhecidas que serão ignoradas */
  allowUnknown: true,
  /** Remover chaves desconhecidas dos dados validados */
  stripUnknown: true,
};

export const validateData = async (
  data: unknown,
  schema: Schema,
  options = _validationOptions,
): Promise<MyObject> => {
  return new Promise((resolve, reject) => {
    const result = schema.validate(data, options);

    return result.error ? reject(result.error) : resolve(result.value);
  });
};

export const validateGqlRequest = (resolver: GqlResolver) => async (
  parent: unknown,
  args: unknown,
  context: MyContext,
  info: GraphQLResolveInfo,
): Promise<unknown> => {
  try {
    const data = await validateData(args, gqlRouter[info.fieldName]);

    context.validData = data;

    return resolver(parent, args, context, info);
  } catch (error) {
    throw VALIDATION_ERROR(error.message);
  }
};

const getSchemaByReq = async (req: Request): Promise<Schema> => {
  const path = req.baseUrl + req.route.path;

  const { method } = req;

  const name = `${method} ${path}`;

  return restRouter[name];
};

// eslint-disable-next-line max-lines-per-function
export const validateRestRequest = async (
  req: Request,
  _: Response,
  next: NextFunction,
): Promise<void> => {
  try {
    const schema = await getSchemaByReq(req);

    const data = { body: req.body, params: req.params, query: req.query };

    const res = await validateData(data, schema);
    const { body, params, query } = res as Partial<Request>;

    req.body = body || req.body;
    req.params = params || req.params;
    req.query = query || req.query;

    next();
  } catch (error) {
    throw VALIDATION_ERROR(error.message);
  }
};
