import {
  fetchOneEmployee,
  deleteOneEmployee,
  checkEmployeeInUse,
} from '../../services/EmployeeServices';
import { MyObject } from '../../types';

export async function deleteEmployee({
  id,
}: {
  id: string;
}): Promise<MyObject> {
  const employee = await fetchOneEmployee({ conditions: { _id: id } });

  await checkEmployeeInUse({ id: employee._id });

  await deleteOneEmployee({ conditions: { _id: employee._id } });

  return {};
}
