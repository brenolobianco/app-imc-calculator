import bcrypt from 'bcrypt';

import { PASSWORD_INCORRECT } from '../middlewares/errorHandling/errors';
import { UserInterface } from '../interfaces';

const comparePassword = (
  encryptedPassword: string,
  candidatePassword: string,
): Promise<boolean> => {
  return bcrypt.compare(candidatePassword, encryptedPassword);
};

export const checkIfPasswordIsCorrect = async (
  user: UserInterface,
  passwordToCheck: string,
): Promise<void> => {
  const isEqual = await comparePassword(user.password, passwordToCheck);

  if (!isEqual) throw PASSWORD_INCORRECT;
};
