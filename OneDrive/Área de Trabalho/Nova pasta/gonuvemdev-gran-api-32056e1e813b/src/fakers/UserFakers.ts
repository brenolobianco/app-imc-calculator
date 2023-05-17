import {
  fakeFullName,
  fakePassword,
  fakeEmail,
  fakeArray,
  fakeRole,
  fakeWord,
} from './fakersUtils';
import { UserInterface } from '../interfaces';
import { Fake } from '../types';

export const fakeUser: Fake<UserInterface> = {
  name: fakeFullName,
  password: fakePassword,
  email: fakeEmail,
  roles: () => fakeArray(fakeRole, 1),
  renewPasswordCode: fakeWord,
};
