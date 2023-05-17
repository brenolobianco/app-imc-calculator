import {
  fakeAddress,
  fakeArray,
  fakeCpf,
  fakeDigitsString,
  fakeEmail,
  fakeFullName,
  fakeId,
  fakePhone,
  fakeRandomArrayElement,
} from './fakersUtils';
import { ClientInterface } from '../interfaces';
import { Fake } from '../types';

export const fakeClient: Fake<ClientInterface> = {
  name: fakeFullName,
  address: fakeAddress,
  primaryPhone: fakePhone,
  secondaryPhones: () => fakeArray(fakePhone),
  email: fakeEmail,
  type: fakeRandomArrayElement(['PF', 'PJ']),
  cpf: fakeCpf,
  cnpj: fakeDigitsString(14),
  rg: fakeDigitsString(7),
  stateRegistration: fakeDigitsString(9),
  adminWhoRegistered: fakeId,
};
