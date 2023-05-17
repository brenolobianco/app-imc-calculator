import { UserDocument, UserInterface } from '../interfaces';

type BasicUser = {
  _id: UserDocument['_id'];
  name: UserDocument['name'];
  email: UserDocument['email'];
  roles: UserDocument['roles'];
};

/** Informações do usuário */
export type UserRoleInfo = {
  /** Id do papel do usuário (admin._id, etc...). É null quando for DEV. */
  _id?: string;
  /** Informações básicas do usuário */
  user: BasicUser;
  /** Comissão do funcionário associado à conta de admin deste usuário */
  commission?: number;
  /** Nome do funcionário associado à conta de admin deste usuário */
  employeeName?: string;
};

export type LoginParams = {
  email: UserInterface['email'];
  password: UserInterface['password'];
};

export type LoginResponse = {
  token?: string;
  info?: UserRoleInfo | null;
};

export type ValidateTokenParams = {
  token: string;
};

export type ForgotPasswordParams = {
  email: UserInterface['email'];
};

export type RenewPasswordParams = {
  email: UserInterface['email'];
  password: UserInterface['password'];
  code: string;
};

export type UpdateOwnProfileInput = {
  name: UserInterface['name'];
  email: UserInterface['email'];
};

export type UpdateOwnPasswordParams = {
  oldPassword: UserInterface['password'];
  newPassword: UserInterface['password'];
};
