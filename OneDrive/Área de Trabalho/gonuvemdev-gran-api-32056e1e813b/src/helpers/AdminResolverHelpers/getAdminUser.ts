import { AdminDocument } from '../../interfaces';
import { fetchOneUserWithoutError } from '../../services/UserServices';

export function getAdminUser(
  admin: AdminDocument,
): ReturnType<typeof fetchOneUserWithoutError> {
  return fetchOneUserWithoutError({ conditions: { _id: admin.user } });
}
