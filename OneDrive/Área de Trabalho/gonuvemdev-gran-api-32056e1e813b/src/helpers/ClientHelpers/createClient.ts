import { ClientDocument, UserDoc } from '../../interfaces';
import { fetchOneAdmin } from '../../services/AdminServices';
import {
  checkClientConflicts,
  createOneClient,
} from '../../services/ClientServices';
import { CreateClientInput } from '../../types';

export async function createClient(
  user: UserDoc,
  input: CreateClientInput,
): Promise<{
  client: ClientDocument;
}> {
  /** Verificar referências e conflitos */
  const [adminWhoRegistered] = await Promise.all([
    fetchOneAdmin({ conditions: { user: user._id } }),
    checkClientConflicts(input),
  ]);

  const client = await createOneClient({
    doc: { ...input, adminWhoRegistered: adminWhoRegistered._id },
  });

  return { client };
}
