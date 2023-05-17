import { Role } from '../../../enums';
import { UserInterface } from '../../../interfaces';
import { JoiSchemaMap } from '../../../types';
import {
  arraySchema,
  emailSchema,
  fullNameSchema,
  passwordSchema,
  renewPasswordCodeSchema,
  stringEnumSchema,
} from './baseSchemas';

export const userRoleSchema = stringEnumSchema(Role);

export const User: JoiSchemaMap<UserInterface> = {
  name: fullNameSchema,
  password: passwordSchema,
  email: emailSchema,
  roles: arraySchema(userRoleSchema.required()),
  renewPasswordCode: renewPasswordCodeSchema,
};
