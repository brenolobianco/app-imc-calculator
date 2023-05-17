import { createOneEmployee } from '../../services/EmployeeServices';
import { EmployeeDocument } from '../../interfaces';
import { CreateEmployeeInput } from '../../types';

export async function createEmployee(
  input: CreateEmployeeInput,
): Promise<{ employee: EmployeeDocument }> {
  const employee = await createOneEmployee({ doc: input });

  return { employee };
}
