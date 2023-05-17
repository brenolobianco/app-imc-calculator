import { ClientInterface, Address, AdminInterface } from '../../interfaces';
import { checkAdmin } from './checkAdmin';
import { checkAddress } from './general';

// eslint-disable-next-line max-lines-per-function
export function checkClient(
  expected: Required<ClientInterface>,
  received: ClientInterface,
): void {
  type T = Required<
    Omit<ClientInterface, 'address' | 'secondaryPhones' | 'adminWhoRegistered'>
  >;

  expect(received).toMatchObject<T>({
    name: expected.name,
    primaryPhone: expected.primaryPhone,
    email: expected.email,
    type: expected.type,
    cpf: expected.cpf,
    cnpj: expected.cnpj,
    rg: expected.rg,
    stateRegistration: expected.stateRegistration,
  });

  // eslint-disable-next-line no-unused-expressions
  received.secondaryPhones?.forEach((phone: string, i: number): void => {
    expect(phone).toBe(expected.secondaryPhones && expected.secondaryPhones[i]);
  });

  checkAddress(
    expected.address as Required<Address>,
    received.address as Address,
  );

  if (received.adminWhoRegistered) {
    checkAdmin(
      expected.adminWhoRegistered as Required<AdminInterface>,
      received.adminWhoRegistered as AdminInterface,
    );
  }
}
