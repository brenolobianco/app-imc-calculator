import { ClientDoc } from '../../interfaces';
import { fetchOneClient } from '../../services/ClientServices';

export async function readClient({
  id,
}: {
  id: string;
}): Promise<{ client: ClientDoc }> {
  const client = await fetchOneClient({ conditions: { _id: id } });

  return { client };
}
