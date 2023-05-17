import { AdminDoc, UserDoc } from '../../interfaces';
import { UpdateOwnProfileInput } from '../../types';
import { fetchAndUpdateAdminWithUser } from '../AdminHelpers';

export async function updateOwnProfile(
  user: UserDoc,
  input: UpdateOwnProfileInput,
): Promise<{ admin: AdminDoc }> {
  const admin = await fetchAndUpdateAdminWithUser({ user: user._id }, input);

  return { admin };
}
