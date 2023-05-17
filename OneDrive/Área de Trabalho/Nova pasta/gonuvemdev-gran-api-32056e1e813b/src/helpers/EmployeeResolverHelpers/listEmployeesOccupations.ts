import Employee from '../../models/Employee';

type Response = { occupations: string[] };
export async function listEmployeesOccupations(): Promise<Response> {
  const occupations = await Employee.distinct('occupation');

  return { occupations };
}
