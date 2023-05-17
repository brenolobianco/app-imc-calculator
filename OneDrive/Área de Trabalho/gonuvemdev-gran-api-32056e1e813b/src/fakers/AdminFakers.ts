import { fakeId } from './fakersUtils';
import { AdminInterface } from '../interfaces';
import { Fake } from '../types';

export const fakeAdmin: Fake<AdminInterface> = {
  user: fakeId,
  employee: fakeId,
};
