import { listEmployeesPaginated } from '../../services/EmployeeServices';
import { createSearchQuery } from '../../utils/search';
import {
  EmployeeFilter,
  ListEmployeesParams,
  ListEmployeesResponse,
  MyObject,
} from '../../types';
import { createFilterQuery } from '../../utils/filter';

async function createListEmployeesConditions(
  q: string,
  filters: EmployeeFilter,
): Promise<MyObject> {
  const [search, filter] = await Promise.all([
    createSearchQuery(['name', 'cpf'])(q),
    createFilterQuery([
      {
        type: 'string',
        name: 'occupation',
        value: filters.occupation as string,
      },
    ]),
  ]);

  return { ...search, ...filter };
}

export async function listEmployees({
  q,
  sort,
  page,
  perPage,
  ...filters
}: ListEmployeesParams): Promise<ListEmployeesResponse> {
  const conditions = await createListEmployeesConditions(q as string, filters);

  const { objects: employees, total, pages } = await listEmployeesPaginated({
    conditions,
    page,
    perPage,
    sort,
  });

  return { employees, total, pages };
}
