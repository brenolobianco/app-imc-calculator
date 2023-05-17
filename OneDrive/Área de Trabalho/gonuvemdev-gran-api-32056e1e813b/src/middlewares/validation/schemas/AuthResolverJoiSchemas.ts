import Joi, { AnySchema } from 'joi';

import { User } from './UserJoiSchemas';
import { basicStringSchema, createSchema } from './baseSchemas';
import {
  LoginParams,
  JoiSchemaMap,
  ValidateTokenParams,
  ForgotPasswordParams,
  RenewPasswordParams,
  UpdateOwnProfileInput,
  UpdateOwnPasswordParams,
} from '../../../types';

const loginKeys: JoiSchemaMap<LoginParams> = {
  email: User.email.required(),
  password: User.password.required(),
};
const login = Joi.object<LoginParams>().keys(loginKeys);

const validateTokenKeys: JoiSchemaMap<ValidateTokenParams> = {
  token: basicStringSchema.required(),
};
const validateToken = Joi.object().keys(validateTokenKeys);

const forgotPasswordKeys: JoiSchemaMap<ForgotPasswordParams> = {
  email: User.email.required(),
};
const forgotPassword = Joi.object<ForgotPasswordParams>().keys(
  forgotPasswordKeys,
);

const renewPasswordKeys: JoiSchemaMap<RenewPasswordParams> = {
  email: User.email.required(),
  password: User.password.required(),
  code: (User.renewPasswordCode as AnySchema).required(),
};
const renewPassword = Joi.object<RenewPasswordParams>().keys(renewPasswordKeys);

const updateOwnProfileKeys: JoiSchemaMap<UpdateOwnProfileInput> = {
  email: User.email.optional(),
  name: User.name.optional(),
};

const updateOwnProfile = createSchema(
  Joi.object<UpdateOwnProfileInput>()
    .keys(updateOwnProfileKeys)
    .or('email', 'name'),
);

const updateOwnPasswordKeys: JoiSchemaMap<UpdateOwnPasswordParams> = {
  oldPassword: User.password.required(),
  newPassword: User.password.required(),
};
const updateOwnPassword = Joi.object().keys(updateOwnPasswordKeys);

export const resolvers = {
  login,
  validateToken,
  forgotPassword,
  renewPassword,
  updateOwnProfile,
  updateOwnPassword,
};
