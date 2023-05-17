import Joi from 'joi';

import {
  createSchema,
  updateSchema,
  removeSchema,
  listSchema,
  readSchema,
  basicStringSchema,
  phoneSchema,
  emailSchema,
  arraySchema,
  dateSchema,
  cpfSchema,
  addressKeys,
  integerSchema,
  digitsStringSchema,
} from './baseSchemas';
import {
  JoiSchemaMap,
  CreateEmployeeInput,
  UpdateEmployeeInput,
} from '../../../types';
import {
  EmployeeBankAccount,
  EmployeeBankData,
  EmployeeCTPS,
  EmployeeInterface,
  EmployeeRelative,
} from '../../../interfaces';

const employeeBankAccountKeys: JoiSchemaMap<Required<EmployeeBankAccount>> = {
  type: basicStringSchema.optional(),
  number: basicStringSchema.optional(),
};

const employeeBankDataKeys: JoiSchemaMap<Required<EmployeeBankData>> = {
  bank: basicStringSchema.optional(),
  agency: basicStringSchema.optional(),
  account: Joi.object(employeeBankAccountKeys).optional(),
};

const employeeCTPSKeys: JoiSchemaMap<Required<EmployeeCTPS>> = {
  pisPasep: basicStringSchema,
  number: basicStringSchema,
  series: basicStringSchema,
  uf: addressKeys.state,
};

const employeeRelativeKeys: JoiSchemaMap<Required<EmployeeRelative>> = {
  kinship: basicStringSchema.required(),
  name: basicStringSchema,
  phone: phoneSchema,
  dob: dateSchema,
};

export const Employee: JoiSchemaMap<Required<EmployeeInterface>> = {
  name: basicStringSchema,
  occupation: basicStringSchema,
  phones: arraySchema(phoneSchema),
  bankData: Joi.object(employeeBankDataKeys),
  email: emailSchema,
  admissionDate: dateSchema,
  dob: dateSchema,
  rg: digitsStringSchema,
  dispatchingBody: basicStringSchema,
  cpf: cpfSchema,
  address: Joi.object(addressKeys),
  maritalStatus: basicStringSchema,
  commission: integerSchema.min(0).max(9999),
  salary: integerSchema.min(0),
  ctps: Joi.object(employeeCTPSKeys),
  educationalLevel: basicStringSchema,
  pob: basicStringSchema,
  relatives: arraySchema(Joi.object(employeeRelativeKeys)),
};

const createKeys: JoiSchemaMap<Required<CreateEmployeeInput>> = {
  name: Employee.name.required(),
  occupation: Employee.occupation.required(),
  phones: Employee.phones.optional(),
  bankData: Employee.bankData.optional(),
  email: Employee.email.optional(),
  admissionDate: Employee.admissionDate.optional(),
  dob: Employee.dob.optional(),
  rg: Employee.rg.optional(),
  dispatchingBody: Employee.dispatchingBody.optional(),
  cpf: Employee.cpf.optional(),
  address: Employee.address.optional(),
  maritalStatus: Employee.maritalStatus.optional(),
  commission: Employee.commission.optional(),
  salary: Employee.salary.optional(),
  ctps: Employee.ctps.optional(),
  educationalLevel: Employee.educationalLevel.optional(),
  pob: Employee.pob.optional(),
  relatives: Employee.relatives.optional(),
};

const create = createSchema(Joi.object().keys(createKeys));

const updateKeys: JoiSchemaMap<Required<UpdateEmployeeInput>> = {
  name: Employee.name.required(),
  occupation: Employee.occupation.required(),
  phones: Employee.phones.optional(),
  bankData: Employee.bankData.optional(),
  email: Employee.email.optional(),
  admissionDate: Employee.admissionDate.optional(),
  dob: Employee.dob.optional(),
  rg: Employee.rg.optional(),
  dispatchingBody: Employee.dispatchingBody.optional(),
  cpf: Employee.cpf.optional(),
  address: Employee.address.optional(),
  maritalStatus: Employee.maritalStatus.optional(),
  commission: Employee.commission.optional(),
  salary: Employee.salary.optional(),
  ctps: Employee.ctps.optional(),
  educationalLevel: Employee.educationalLevel.optional(),
  pob: Employee.pob.optional(),
  relatives: Employee.relatives.optional(),
};
const update = updateSchema(Joi.object().keys(updateKeys));

const remove = removeSchema;

const sortFields = ['-name', 'name', '-createdAt', 'createdAt'];
const defaultField = 'name';
const filters = {
  occupation: Employee.occupation.optional(),
};

const list = listSchema(sortFields, defaultField, filters);

const read = readSchema;

export const resolvers = {
  createEmployee: create,
  updateEmployee: update,
  deleteEmployee: remove,
  listEmployees: list,
  readEmployee: read,
};
