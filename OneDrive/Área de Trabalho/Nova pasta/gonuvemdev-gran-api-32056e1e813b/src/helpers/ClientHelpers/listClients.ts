import { listClientsPaginated } from '../../services/ClientServices';
import {
  ClientFilter,
  MyObject,
  ListClientsParams,
  ListClientsResponse,
  ID,
} from '../../types';
import { createFilterQuery } from '../../utils/filter';
import { createSearchQuery } from '../../utils/search';

async function createListClientsConditions(
  q: string,
  filters: ClientFilter,
): Promise<MyObject> {
  const [search, filter] = await Promise.all([
    createSearchQuery(['name', 'primaryPhone', 'secondaryPhones'])(q),
    createFilterQuery([
      { type: 'string', name: 'type', value: filters.type as 'PF' | 'PJ' },
      {
        type: 'id',
        name: 'adminWhoRegistered',
        value: filters.adminWhoRegistered as ID,
      },
    ]),
  ]);

  return { ...search, ...filter };
}

export async function listClients({
  q,
  sort,
  page,
  perPage,
  ...filters
}: ListClientsParams): Promise<ListClientsResponse> {
  const conditions = await createListClientsConditions(q as string, filters);

  const { objects: clients, total, pages } = await listClientsPaginated({
    conditions,
    page,
    perPage,
    sort,
  });

  return { clients, total, pages };
}
