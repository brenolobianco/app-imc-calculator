import { addressFieldsQuery } from './general';

export const employeeFieldsQuery = `{
  _id
  name
  occupation
  phones
  bankData {
    bank
    agency
    account {
      type
      number
    }
  }
  email
  admissionDate
  dob
  rg
  dispatchingBody
  cpf
  address ${addressFieldsQuery}
  maritalStatus
  commission
  salary
  ctps {
    pisPasep
    number
    series
    uf
  }
  educationalLevel
  pob
  relatives {
    kinship
    name
    phone
    dob
  }
  email
  createdAt
  updatedAt
}`;
