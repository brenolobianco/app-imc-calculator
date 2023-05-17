import { AddressInput } from '../../types';

export const createInputAddress = (input: AddressInput): string => `{
  street: "${input.street}"
  number: "${input.number}"
  district: "${input.district}"
  city: "${input.city}"
  state: "${input.state}"
  postalCode: "${input.postalCode}"
  complement: "${input.complement}"
}`;
