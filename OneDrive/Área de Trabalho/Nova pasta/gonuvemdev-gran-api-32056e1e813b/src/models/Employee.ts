import mongoose, { SchemaDefinition } from 'mongoose';

import {
  EmployeeBankAccount,
  EmployeeBankData,
  EmployeeCTPS,
  EmployeeDocument,
  EmployeeInterface,
  EmployeeRelative,
} from '../interfaces';
import { MongooseDefinition } from '../types';
import { AddressSchema } from '../utils/mongoose';

const employeeBankAccountDefinition: MongooseDefinition<EmployeeBankAccount> = {
  type: String,
  number: String,
};

const EmployeeBankAccountSchema = new mongoose.Schema(
  employeeBankAccountDefinition as SchemaDefinition,
  { _id: false },
);

const employeeBankDataDefinition: MongooseDefinition<EmployeeBankData> = {
  bank: String,
  agency: String,
  account: EmployeeBankAccountSchema,
};

const EmployeeBankDataSchema = new mongoose.Schema(
  employeeBankDataDefinition as SchemaDefinition,
  { _id: false },
);

const employeeCTPSDefinition: MongooseDefinition<EmployeeCTPS> = {
  pisPasep: String,
  number: String,
  series: String,
  uf: String,
};

const EmployeeCTPSSchema = new mongoose.Schema(
  employeeCTPSDefinition as SchemaDefinition,
  { _id: false },
);

const employeeRelativeDefinition: MongooseDefinition<EmployeeRelative> = {
  kinship: {
    type: String,
    required: true,
  },
  name: String,
  dob: Date,
  phone: String,
};

const EmployeeRelativeSchema = new mongoose.Schema(
  employeeRelativeDefinition as SchemaDefinition,
  { _id: false },
);

const definition: MongooseDefinition<EmployeeInterface> = {
  name: {
    type: String,
    required: true,
  },
  occupation: {
    type: String,
    required: true,
  },
  phones: [String],
  bankData: EmployeeBankDataSchema,
  email: String,
  admissionDate: Date,
  dob: Date,
  rg: String,
  dispatchingBody: String,
  cpf: String,
  address: AddressSchema,
  maritalStatus: String,
  commission: Number,
  salary: Number,
  ctps: EmployeeCTPSSchema,
  educationalLevel: String,
  pob: String,
  relatives: [EmployeeRelativeSchema],
};

const EmployeeSchema = new mongoose.Schema(definition as SchemaDefinition, {
  timestamps: true,
});

const Employee = mongoose.model<EmployeeDocument>('Employee', EmployeeSchema);

export default Employee;
