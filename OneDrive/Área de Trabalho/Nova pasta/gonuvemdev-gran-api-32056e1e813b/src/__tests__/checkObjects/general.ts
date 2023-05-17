import { Address } from '../../interfaces';

export const checkAddress = (
  expected: Required<Address>,
  received: Address,
): void => {
  expect(received).toMatchObject<Address>({
    street: expected.street,
    number: expected.number,
    district: expected.district,
    city: expected.city,
    state: expected.state,
    postalCode: expected.postalCode,
    complement: expected.complement,
  });
};

export const getISODateString = (date: Date) =>
  date instanceof Date ? date.toISOString() : date;
