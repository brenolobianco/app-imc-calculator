import { adminFieldsQuery } from './adminFieldsQuery';
import { addressFieldsQuery } from './general';

export const clientFieldsQuery = `{
  _id
  name
  address ${addressFieldsQuery}
  primaryPhone
  secondaryPhones
  email
  type
  cpf
  cnpj
  rg
  stateRegistration
  adminWhoRegistered ${adminFieldsQuery}
  orders {
    code
  }
  createdAt
  updatedAt
}`;
