import { ClientDocument } from '../../interfaces';
import { fetchOneAdminWithoutError } from '../../services/AdminServices';

export async function getClientAdminWhoRegistered(
  client: ClientDocument,
): Promise<ReturnType<typeof fetchOneAdminWithoutError>> {
  return fetchOneAdminWithoutError({
    conditions: { _id: client.adminWhoRegistered },
  });
}
