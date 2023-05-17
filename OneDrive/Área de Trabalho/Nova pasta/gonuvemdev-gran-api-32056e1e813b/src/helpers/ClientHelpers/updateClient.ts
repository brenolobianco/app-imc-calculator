import { ClientDoc } from '../../interfaces';
import { fetchOneAdmin } from '../../services/AdminServices';
import {
  fetchOneClient,
  checkClientConflicts,
  updateOneClient,
} from '../../services/ClientServices';
import { UpdateClientInput } from '../../types';

// eslint-disable-next-line max-lines-per-function
export async function updateClient({
  id,
  input,
}: {
  id: string;
  input: UpdateClientInput;
}): Promise<{ client: ClientDoc }> {
  const client = await fetchOneClient({ conditions: { _id: id } });

  /** Verificar referências e conflitos */
  if (input.primaryPhone) await checkClientConflicts(input, client._id);

  const clientUpdated = await updateOneClient({
    conditions: { _id: client._id },
    updateData: input,
  });

  return { client: clientUpdated };
}
