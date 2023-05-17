import DataLoader from 'dataloader';

import { ListParams, ListResponse } from './general';
import { ClientInterface, ClientDocument, OrderDocument } from '../interfaces';

/** Parâmetros para cadastro de Cliente */
export type CreateClientInput = {
  /** Nome. Mínimo: 1 caracter */
  name: ClientInterface['name'];
  /** Endereço */
  address: ClientInterface['address'];
  /** Telefone principal. String com 10 ou 11 dígitos */
  primaryPhone: ClientInterface['primaryPhone'];
  /** Telefones secundários. Array de String com 10 ou 11 dígitos */
  secondaryPhones: ClientInterface['secondaryPhones'];
  /** E-mail. Formato de email válido */
  email: ClientInterface['email'];
  /** Tipo. Valores válidos ['PF', 'PJ']. Default: 'PF' */
  type: ClientInterface['type'];
  /** CPF. String com 11 dígitos */
  cpf: ClientInterface['cpf'];
  /** CNPJ. String com 14 dígitos */
  cnpj: ClientInterface['cnpj'];
  /** RG. Apenas dígitos. Mínimo: 1 caracter */
  rg: ClientInterface['rg'];
  /** Inscrição Estadual. String com 9 dígitos */
  stateRegistration: ClientInterface['stateRegistration'];
};

/** Parâmetros para atualização de Cliente */
export type UpdateClientInput = {
  /** Nome. Mínimo: 1 caracter */
  name?: ClientInterface['name'];
  /** Endereço */
  address?: ClientInterface['address'];
  /** Telefone principal. String com 10 ou 11 dígitos */
  primaryPhone?: ClientInterface['primaryPhone'];
  /** Telefones secundários. Array de String com 10 ou 11 dígitos */
  secondaryPhones?: ClientInterface['secondaryPhones'];
  /** E-mail. Formato de email válido */
  email?: ClientInterface['email'];
  /** Tipo. Valores válidos ['PF', 'PJ']. Default: 'PF' */
  type?: ClientInterface['type'];
  /** CPF. String com 11 dígitos */
  cpf?: ClientInterface['cpf'];
  /** CNPJ. String com 14 dígitos */
  cnpj?: ClientInterface['cnpj'];
  /** RG. Apenas dígitos. Mínimo: 1 caracter */
  rg?: ClientInterface['rg'];
  /** Inscrição Estadual. String com 9 dígitos */
  stateRegistration?: ClientInterface['stateRegistration'];
};

/** Filtros de Cliente */
export type ClientFilter = {
  /** Filtro de tipo. Valores válidos ['PF', 'PJ'] */
  type?: ClientInterface['type'];
  /** Filtro de Administrador */
  adminWhoRegistered?: ClientInterface['adminWhoRegistered'];
};

export type ListClientsParams = ListParams<ClientFilter>;

export type ListClientsResponse = ListResponse & {
  clients: ClientDocument[];
};

export type ClientOrdersDataLoader = DataLoader<
  ClientDocument,
  OrderDocument[],
  ClientDocument[]
>;
