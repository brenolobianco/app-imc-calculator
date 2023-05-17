import {
  EmployeeInterface,
  EmployeeBankData,
  EmployeeBankAccount,
  Address,
  EmployeeCTPS,
  EmployeeRelative,
} from '../../interfaces';
import { checkAddress, getISODateString } from './general';

// eslint-disable-next-line max-lines-per-function
export const checkEmployee = (
  expected: Required<EmployeeInterface>,
  received: EmployeeInterface,
): void => {
  expect(received).toMatchObject<EmployeeInterface>({
    name: expected.name,
    occupation: expected.occupation,
    email: expected.email,
    rg: expected.rg,
    dispatchingBody: expected.dispatchingBody,
    cpf: expected.cpf,
    maritalStatus: expected.maritalStatus,
    commission: expected.commission,
    salary: expected.salary,
    educationalLevel: expected.educationalLevel,
    pob: expected.pob,
  });

  const { admissionDate, dob } = expected;
  expect(received).toMatchObject({
    admissionDate: getISODateString(admissionDate),
    dob: getISODateString(dob),
  });

  // eslint-disable-next-line no-unused-expressions
  received.phones?.forEach((phone: string, i: number): void => {
    expect(phone).toBe(expected.phones && expected.phones[i]);
  });

  expect(received.bankData).toMatchObject<EmployeeBankData>({
    bank: expected.bankData?.bank,
    agency: expected.bankData?.agency,
  });

  expect(received.bankData?.account).toMatchObject<EmployeeBankAccount>({
    type: expected.bankData?.account?.type,
    number: expected.bankData?.account?.number,
  });

  checkAddress(
    expected.address as Required<Address>,
    received.address as Address,
  );

  expect(received.ctps).toMatchObject<EmployeeCTPS>({
    pisPasep: expected.ctps?.pisPasep,
    number: expected.ctps?.number,
    series: expected.ctps?.series,
    uf: expected.ctps?.uf,
  });

  // eslint-disable-next-line no-unused-expressions
  received.relatives?.forEach((relative, i) => {
    expect(relative).toMatchObject<EmployeeRelative>({
      kinship: expected.relatives[i].kinship,
      name: expected.relatives[i].name,
      phone: expected.relatives[i].phone,
    });

    expect(relative.dob).toBe(
      getISODateString(expected.relatives[i].dob as Date),
    );
  });
};
