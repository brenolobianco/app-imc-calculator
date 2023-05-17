import { AddressInput, ListParams, ListResponse } from './general';
import {
  EmployeeBankAccount,
  EmployeeBankData,
  EmployeeCTPS,
  EmployeeDocument,
  EmployeeInterface,
  EmployeeRelative,
} from '../interfaces';

export type EmployeeBankAccountInput = {
  type?: EmployeeBankAccount['type'];
  number?: EmployeeBankAccount['number'];
};

export type EmployeeBankDataInput = {
  bank?: EmployeeBankData['bank'];
  agency?: EmployeeBankData['agency'];
  account?: EmployeeBankAccountInput;
};

/** Parâmetros do objeto CTPS de Funcionário. */
export type EmployeeCTPSInput = {
  /** PIS/PASEP. Mínimo: 1 caracter. */
  pisPasep?: EmployeeCTPS['pisPasep'];
  /** Número. Mínimo: 1 caracter. */
  number?: EmployeeCTPS['number'];
  /** Série. Mínimo: 1 caracter. */
  series?: EmployeeCTPS['series'];
  /** UF. Sigla do estado em maiúsculas. */
  uf?: EmployeeCTPS['uf'];
};

/** Parâmetros do objeto Parente de Funcionário */
export type EmployeeRelativeInput = {
  /** Parentesco. Mínimo: 1 caracter. */
  kinship: EmployeeRelative['kinship'];
  /** Nome. Mínimo: 1 caracter. */
  name?: EmployeeRelative['name'];
  /** Telefone. String com 10 ou 11 dígitos. */
  phone?: EmployeeRelative['phone'];
  /** Data de nascimento. Date em ISOString. */
  dob?: EmployeeRelative['dob'];
};

export type CreateEmployeeInput = {
  /** Nome. Mínimo: 1 caracter. */
  name: EmployeeInterface['name'];
  /** Cargo. Mínimo: 1 caracter. */
  occupation: EmployeeInterface['occupation'];
  /** Telefones. Array de String de dígitos com tamanho 10 ou 11. */
  phones?: EmployeeInterface['phones'];
  /** Dados bancários */
  bankData?: EmployeeBankDataInput;
  /** Email. Formato de email válido. */
  email?: EmployeeInterface['email'];
  /** Data de admissão. Date em ISOString. */
  admissionDate?: EmployeeInterface['admissionDate'];
  /** Data de nascimento. Date em ISOString. */
  dob?: EmployeeInterface['dob'];
  /** RG. Mínimo: 1 caracter. */
  rg?: EmployeeInterface['rg'];
  /** Orgão expedidor do RG. Mínimo 1 caracter. */
  dispatchingBody?: EmployeeInterface['dispatchingBody'];
  /** CPF. String com 11 dígitos. */
  cpf?: EmployeeInterface['cpf'];
  /** Endereço */
  address?: AddressInput;
  /** Estado civil. Mínimo: 1 caracter. */
  maritalStatus?: EmployeeInterface['maritalStatus'];
  /** Comissão. Antigo RT (Reserva Técnica). Valor entre 0 (0,00%) e 10000 (100,00%). */
  commission?: EmployeeInterface['commission'];
  /** Salário. Valor em centavos. Mínimo: 0. */
  salary?: EmployeeInterface['salary'];
  /** Carteira de Trabalho e Previdência Social */
  ctps?: EmployeeCTPSInput;
  /** Escolaridade. Mínimo: 1 caracter. */
  educationalLevel?: EmployeeInterface['educationalLevel'];
  /** Naturalidade (Local de Nascimento). Mínimo: 1 caracter. */
  pob?: EmployeeInterface['pob'];
  /** Parentes */
  relatives?: EmployeeRelativeInput[];
};

export type UpdateEmployeeInput = {
  /** Nome. Mínimo: 1 caracter. */
  name?: EmployeeInterface['name'];
  /** Cargo. Mínimo: 1 caracter. */
  occupation?: EmployeeInterface['occupation'];
  /** Telefones. Array de String de dígitos com tamanho 10 ou 11. */
  phones?: EmployeeInterface['phones'];
  /** Dados bancários */
  bankData?: EmployeeBankDataInput;
  /** Email. Formato de email válido. */
  email?: EmployeeInterface['email'];
  /** Data de admissão. Date em ISOString. */
  admissionDate?: EmployeeInterface['admissionDate'];
  /** Data de nascimento. Date em ISOString. */
  dob?: EmployeeInterface['dob'];
  /** RG. Mínimo: 1 caracter. */
  rg?: EmployeeInterface['rg'];
  /** Orgão expedidor do RG. Mínimo 1 caracter. */
  dispatchingBody?: EmployeeInterface['dispatchingBody'];
  /** CPF. String com 11 dígitos. */
  cpf?: EmployeeInterface['cpf'];
  /** Endereço */
  address?: AddressInput;
  /** Estado civil. Mínimo: 1 caracter. */
  maritalStatus?: EmployeeInterface['maritalStatus'];
  /** Comissão. Antigo RT (Reserva Técnica). Valor entre 0 (0,00%) e 10000 (100,00%). */
  commission?: EmployeeInterface['commission'];
  /** Salário. Valor em centavos. Mínimo: 0. */
  salary?: EmployeeInterface['salary'];
  /** Carteira de Trabalho e Previdência Social */
  ctps?: EmployeeCTPSInput;
  /** Escolaridade. Mínimo: 1 caracter. */
  educationalLevel?: EmployeeInterface['educationalLevel'];
  /** Naturalidade (Local de Nascimento). Mínimo: 1 caracter. */
  pob?: EmployeeInterface['pob'];
  /** Parentes */
  relatives?: EmployeeRelativeInput[];
};

export type EmployeeFilter = {
  /** Filtro de cargo */
  occupation?: EmployeeInterface['occupation'];
};

export type ListEmployeesParams = ListParams<EmployeeFilter>;

export type ListEmployeesResponse = ListResponse & {
  employees: EmployeeDocument[];
};
