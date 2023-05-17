import { AdminDoc, UserDoc } from '../../interfaces';
import { fetchOneAdmin } from '../../services/AdminServices';

export async function readOwnProfile(
  user: UserDoc,
): Promise<{ admin: AdminDoc }> {
  const admin = await fetchOneAdmin({ conditions: { user: user._id } });

  return { admin };
}
