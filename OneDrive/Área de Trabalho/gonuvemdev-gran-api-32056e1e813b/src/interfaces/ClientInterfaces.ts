import { Document } from 'mongoose';

import { ID } from '../types';
import { AdminDoc } from './AdminInterfaces';
import { Address, Timestamps } from './general';

/** Cliente */
export interface ClientInterface {
  /** Nome */
  name?: string;
  /** Endereço */
  address?: Address;
  /** Telefone principal */
  primaryPhone: string;
  /** Telefones secundários */
  secondaryPhones?: string[];
  /** E-mail */
  email?: string;
  /** Tipo. Valores válidos ['PF', 'PJ'] */
  type: 'PF' | 'PJ';
  /** CPF */
  cpf?: string;
  /** CNPJ */
  cnpj?: string;
  /** RG */
  rg?: string;
  /** Inscrição Estadual */
  stateRegistration?: string;
  /** Administrador que realizou o cadastro deste Cliente */
  adminWhoRegistered?: AdminDoc | ID;
}

// eslint-disable-next-line prettier/prettier
export interface ClientDocument extends ClientInterface, Document, Timestamps { }

export interface ClientDoc extends ClientInterface, Timestamps {
  _id: ID;
}
