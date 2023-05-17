// eslint-disable-next-line import/no-extraneous-dependencies
import { Context } from 'apollo-server-core';
import { Types, SchemaTypeOpts, Schema, SchemaType } from 'mongoose';
import { NextFunction, Request, Response } from 'express';
import Joi from 'joi';
import { GraphQLResolveInfo } from 'graphql';

import { Address, UserDoc } from '../interfaces';

export type ID = Types.ObjectId | string;

export type MyObject = Record<string, unknown>;

export type MyError = {
  message: string;
  statusCode: number;
  internalCode: number;
  internalError?: Error;
};

export type TokenPayload = {
  _id: ID;
};

type Loader<L> = {
  [key: string]: L;
};

export type MyContext<T = MyObject, L = MyObject> = Context & {
  req: Request;
  res: Response;
  validData: T;
  user: UserDoc;
  loaders: Loader<L>;
};

/** Cria um contrato entre os schemas de validação e a interface passada */
export type JoiSchemaMap<T> = {
  [key in keyof Required<T>]: Joi.AnySchema;
};

/** Cria um contrato entre as definições de model e a interface passada */
export type MongooseDefinition<T> = {
  [key in keyof Required<T>]: SchemaTypeOpts<unknown> | Schema | SchemaType;
};

/** Cria um contrato entre os campos de uma fábrica e a interface passada */
export type Fake<T> = {
  [key in keyof Required<T>]: () => T[key];
};

export type GqlResolver = (
  parent: unknown,
  args: unknown,
  context: any,
  info: GraphQLResolveInfo,
) => any;

export type ExpressHandler = (
  req: Request,
  res: Response,
  next: NextFunction,
) => any;

export type ListParams<Filters = MyObject> = {
  /** Mínimo: 1 caracter. Máximo: 100 caracteres. */
  q?: string;
  page: number;
  perPage: number;
  sort: string;
} & Filters;

export type ListResponse = {
  total: number;
  pages: number;
};

/** Parâmetros do objeto Endereço. */
export type AddressInput = {
  /** Rua/Logradouro. Máximo: 80 caracteres. */
  street?: Address['street'];
  /** Número. Máximo: 20 caracteres. */
  number?: Address['number'];
  /** Bairro. Máximo: 60 caracteres. */
  district?: Address['district'];
  /** Cidade. Mínimo: 2 caracteres. Máximo: 60 caracteres. */
  city?: Address['city'];
  /** Estado. Sigla do estado em maiúsculas. */
  state?: Address['state'];
  /** CEP. String com 8 dígitos. */
  postalCode?: Address['postalCode'];
  /** Complemento. Máximo: 40 caracteres. */
  complement?: Address['complement'];
};
