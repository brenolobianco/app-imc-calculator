import { AdminDoc } from '../../interfaces';
import { fetchOneAdmin } from '../../services/AdminServices';

export async function readAdmin({
  id,
}: {
  id: string;
}): Promise<{ admin: AdminDoc }> {
  const admin = await fetchOneAdmin({ conditions: { _id: id } });

  return { admin };
}
