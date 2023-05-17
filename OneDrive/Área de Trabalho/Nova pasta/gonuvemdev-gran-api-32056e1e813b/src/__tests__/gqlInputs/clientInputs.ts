import {
  CreateClientInput,
  AddressInput,
  UpdateClientInput,
} from '../../types';
import { createArrayInput, createStringValue } from '../gqlTestHelper';
import { createInputAddress } from './general';

export function createInputCreateClient(input: CreateClientInput): string {
  const secondaryPhones = createArrayInput(
    input.secondaryPhones as string[],
    createStringValue,
  );

  return `{
    name: "${input.name}",
    address: ${createInputAddress(input.address as AddressInput)},
    primaryPhone: "${input.primaryPhone}",
    secondaryPhones: ${secondaryPhones},
    email: "${input.email}",
    type: "${input.type}",
    cpf: "${input.cpf}",
    cnpj: "${input.cnpj}",
    rg: "${input.rg}",
    stateRegistration: "${input.stateRegistration}",
  }`;
}

export function createInputUpdateClient(
  input: Required<UpdateClientInput>,
): string {
  return createInputCreateClient(input);
}
