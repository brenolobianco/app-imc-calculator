import { fetchOneEmployee } from '../../services/EmployeeServices';
import { EmployeeDoc } from '../../interfaces';

export async function readEmployee({
  id,
}: {
  id: string;
}): Promise<{ employee: EmployeeDoc }> {
  const employee = await fetchOneEmployee({ conditions: { _id: id } });

  return { employee };
}
