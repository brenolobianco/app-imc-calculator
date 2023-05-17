/* eslint-disable no-param-reassign */
import { MyObject, RenewPasswordParams } from '../../types';
import { UserDocument } from '../../interfaces';
import { fetchOneUser } from '../../services/UserServices';
import { WRONG_RENEW_PASSWORD_CODE } from '../../middlewares/errorHandling/errors';

const renewUserPassword = async (
  user: UserDocument,
  renewPasswordCode: string,
  newPassword: string,
): Promise<void> => {
  if (user.renewPasswordCode !== renewPasswordCode) {
    throw WRONG_RENEW_PASSWORD_CODE;
  }

  user.password = newPassword;
  user.renewPasswordCode = '';

  await user.save();
};

export async function renewPassword({
  email,
  password,
  code,
}: RenewPasswordParams): Promise<MyObject> {
  const user = await fetchOneUser({ conditions: { email }, lean: false });

  await renewUserPassword(user as UserDocument, code, password);

  return {};
}
