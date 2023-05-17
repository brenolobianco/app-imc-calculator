import { Document } from 'mongoose';

import { Address, Timestamps } from './general';
import { ID } from '../types';

/** Conta bancária do funcionário */
export interface EmployeeBankAccount {
  /** Tipo */
  type?: string;
  /** Número */
  number?: string;
}

/** Dados bancários do funcionário */
export interface EmployeeBankData {
  /** Banco */
  bank?: string;
  /** Agência */
  agency?: string;
  /** Conta */
  account?: EmployeeBankAccount;
}

/** Carteira de Trabalho e Previdência Social do Funcionário */
export interface EmployeeCTPS {
  /** PIS/PASEP */
  pisPasep?: string;
  /** Número */
  number?: string;
  /** Série */
  series?: string;
  /** UF */
  uf?: string;
}

/** Parente do Funcionário */
export interface EmployeeRelative {
  /** Parentesco */
  kinship: string;
  /** Nome */
  name?: string;
  /** Telefone */
  phone?: string;
  /** Data de nascimento */
  dob?: Date;
}

/** Funcionário */
export interface EmployeeInterface {
  /** Nome */
  name: string;
  /** Cargo */
  occupation: string;
  /** Telefones */
  phones?: string[];
  /** Dados bancários */
  bankData?: EmployeeBankData;
  /** Email */
  email?: string;
  /** Data de admissão */
  admissionDate?: Date;
  /** Data de nascimento */
  dob?: Date;
  /** RG */
  rg?: string;
  /** Orgão expedidor do RG */
  dispatchingBody?: string;
  /** CPF */
  cpf?: string;
  /** Endereço */
  address?: Address;
  /** Estado civil */
  maritalStatus?: string;
  /** Comissão. Antigo RT (Reserva Técnica) */
  commission?: number;
  /** Salário */
  salary?: number;
  /** Carteira de Trabalho e Previdência Social */
  ctps?: EmployeeCTPS;
  /** Escolaridade */
  educationalLevel?: string;
  /** Naturalidade (Local de Nascimento) */
  pob?: string;
  /** Parentes */
  relatives?: EmployeeRelative[];
}

// eslint-disable-next-line prettier/prettier
export interface EmployeeDocument extends EmployeeInterface, Document, Timestamps { }

export interface EmployeeDoc extends EmployeeInterface, Timestamps {
  _id: ID;
}
