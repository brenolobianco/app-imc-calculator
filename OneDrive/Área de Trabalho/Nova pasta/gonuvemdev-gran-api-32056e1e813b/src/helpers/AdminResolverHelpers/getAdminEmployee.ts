import { AdminDocument } from '../../interfaces';
import { fetchOneEmployeeWithoutError } from '../../services/EmployeeServices';

export function getAdminEmployee(
  admin: AdminDocument,
): ReturnType<typeof fetchOneEmployeeWithoutError> {
  return fetchOneEmployeeWithoutError({ conditions: { _id: admin.employee } });
}
