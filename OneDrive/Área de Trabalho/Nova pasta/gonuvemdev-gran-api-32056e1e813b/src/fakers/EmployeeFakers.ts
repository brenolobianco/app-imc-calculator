import {
  fakeAddress,
  fakeArray,
  fakeCpf,
  fakeDigitsString,
  fakeEmail,
  fakeFullName,
  fakeJobTitle,
  fakePastDate,
  fakePhone,
  fakeRandomInt,
  fakeWord,
} from './fakersUtils';
import {
  EmployeeBankAccount,
  EmployeeBankData,
  EmployeeCTPS,
  EmployeeInterface,
  EmployeeRelative,
} from '../interfaces';
import { Fake } from '../types';

function fakeEmployeeBankAccount(): EmployeeBankAccount {
  return {
    type: fakeWord(),
    number: fakeDigitsString(5)(),
  };
}

function fakeEmployeeBankData(): EmployeeBankData {
  return {
    bank: fakeWord(),
    agency: fakeDigitsString(4)(),
    account: fakeEmployeeBankAccount(),
  };
}

function fakeEmployeeCTPS(): EmployeeCTPS {
  return {
    pisPasep: fakeDigitsString(11)(),
    number: fakeDigitsString(7)(),
    series: fakeDigitsString(4)(),
    uf: 'PR',
  };
}

function fakeEmployeeRelative(): EmployeeRelative {
  return {
    kinship: fakeWord(),
    name: fakeFullName(),
    phone: fakePhone(),
    dob: fakePastDate(),
  };
}

export const fakeEmployee: Fake<EmployeeInterface> = {
  name: fakeFullName,
  occupation: fakeJobTitle,
  phones: () => fakeArray(fakePhone),
  bankData: fakeEmployeeBankData,
  email: fakeEmail,
  admissionDate: fakePastDate,
  dob: fakePastDate,
  rg: fakeDigitsString(7),
  dispatchingBody: fakeWord,
  cpf: fakeCpf,
  address: fakeAddress,
  maritalStatus: fakeWord,
  commission: fakeRandomInt({ min: 0, max: 9999 }),
  salary: fakeRandomInt({ min: 104500 }),
  ctps: fakeEmployeeCTPS,
  educationalLevel: fakeWord,
  pob: () => fakeAddress().city,
  relatives: () => fakeArray(fakeEmployeeRelative, 6),
};
