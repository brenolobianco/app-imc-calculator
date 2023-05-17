import {
  fetchOneClient,
  deleteOneClient,
  checkClientInUse,
} from '../../services/ClientServices';
import { MyObject } from '../../types';

export async function deleteClient({ id }: { id: string }): Promise<MyObject> {
  const client = await fetchOneClient({ conditions: { _id: id } });

  /** Verificar se está em uso por outros objetos */
  await checkClientInUse({ id: client._id });

  await deleteOneClient({ conditions: { _id: client._id } });

  return {};
}
