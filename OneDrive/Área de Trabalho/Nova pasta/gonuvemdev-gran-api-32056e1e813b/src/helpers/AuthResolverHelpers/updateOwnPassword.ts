import { UserDoc, UserDocument } from '../../interfaces';
import { UpdateOwnPasswordParams } from '../../types';
import { fetchOneUser } from '../../services/UserServices';
import { checkIfPasswordIsCorrect } from '../UserHelpers';

export async function updateOwnPassword(
  user: UserDoc,
  { oldPassword, newPassword }: UpdateOwnPasswordParams,
): Promise<{ user: UserDocument }> {
  const userObj = await fetchOneUser({
    conditions: { _id: user._id },
    lean: false,
  });

  await checkIfPasswordIsCorrect(userObj, oldPassword);

  userObj.password = newPassword;

  const userUpdated = await (userObj as UserDocument).save();

  return { user: userUpdated };
}
