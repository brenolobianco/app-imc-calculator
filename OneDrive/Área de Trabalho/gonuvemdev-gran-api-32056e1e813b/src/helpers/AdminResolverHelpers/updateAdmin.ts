import { UpdateAdminInput } from '../../types';
import { AdminDoc } from '../../interfaces';
import { fetchAndUpdateAdminWithUser } from '../AdminHelpers';

export async function updateAdmin({
  id,
  input,
}: {
  id: string;
  input: UpdateAdminInput;
}): Promise<{ admin: AdminDoc }> {
  const admin = await fetchAndUpdateAdminWithUser({ _id: id }, input);

  return { admin };
}
