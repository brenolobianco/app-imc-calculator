import {
  CreateEmployeeInput,
  AddressInput,
  EmployeeRelativeInput,
  UpdateEmployeeInput,
} from '../../types';
import { createArrayInput, createStringValue } from '../gqlTestHelper';
import { createInputAddress } from './general';

// eslint-disable-next-line max-lines-per-function
export const createInputCreateEmployee = (
  input: CreateEmployeeInput,
): string => {
  const bankData = `{
    bank: "${input.bankData?.bank}",
    agency: "${input.bankData?.agency}",
    account: {
      type: "${input.bankData?.account?.type}",
      number: "${input.bankData?.account?.number}",
    }
  }`;

  const address = createInputAddress(input.address as AddressInput);

  const ctps = `{
    pisPasep: "${input.ctps?.pisPasep}"
    number: "${input.ctps?.number}"
    series: "${input.ctps?.series}"
    uf: "${input.ctps?.uf}"
  }`;

  const createInputEmployeeRelative = (
    relative: EmployeeRelativeInput,
  ): string => `{
    kinship: "${relative.kinship}"
    name: "${relative.name}"
    phone: "${relative.phone}"
    dob: "${relative.dob?.toISOString()}"
  }`;

  const relatives = createArrayInput(
    input.relatives as EmployeeRelativeInput[],
    createInputEmployeeRelative,
  );

  return `{
    name: "${input.name}",
    occupation: "${input.occupation}",
    phones: ${createArrayInput(input.phones as string[], createStringValue)},
    bankData: ${bankData},
    email: "${input.email}",
    admissionDate: "${input.admissionDate?.toISOString()}",
    dob: "${input.dob?.toISOString()}",
    rg: "${input.rg}",
    dispatchingBody: "${input.dispatchingBody}",
    cpf: "${input.cpf}",
    address: ${address},
    maritalStatus: "${input.maritalStatus}",
    commission: ${input.commission},
    salary: ${input.salary},
    ctps: ${ctps},
    educationalLevel: "${input.educationalLevel}",
    pob: "${input.pob}",
    relatives: ${relatives},
}`;
};

export function createInputUpdateEmployee(
  input: Required<UpdateEmployeeInput>,
): string {
  return createInputCreateEmployee(input);
}
