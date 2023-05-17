import { Document } from 'mongoose';

import { Timestamps } from './general';
import { ID } from '../types';
import { Role } from '../enums';

export interface UserInterface {
  /** Nome completo */
  name: string;

  /** E-mail */
  email: string;

  /** Senha */
  password: string;

  /** Lista de papéis */
  roles: Role[];

  /** Código para renovação de senha */
  renewPasswordCode?: string;
}

// eslint-disable-next-line prettier/prettier
export interface UserDocument extends UserInterface, Document, Timestamps { }

export interface UserDoc extends UserInterface, Timestamps {
  _id: ID;
}
