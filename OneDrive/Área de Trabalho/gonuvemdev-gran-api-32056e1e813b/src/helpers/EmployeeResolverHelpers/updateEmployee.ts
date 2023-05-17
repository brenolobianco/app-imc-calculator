import {
  fetchOneEmployee,
  updateOneEmployee,
} from '../../services/EmployeeServices';
import { UpdateEmployeeInput } from '../../types';
import { EmployeeDoc } from '../../interfaces';

export async function updateEmployee({
  id,
  input,
}: {
  id: string;
  input: UpdateEmployeeInput;
}): Promise<{ employee: EmployeeDoc }> {
  const employee = await fetchOneEmployee({ conditions: { _id: id } });

  const employeeUpdated = await updateOneEmployee({
    conditions: { _id: employee._id },
    updateData: input,
  });

  return { employee: employeeUpdated };
}
