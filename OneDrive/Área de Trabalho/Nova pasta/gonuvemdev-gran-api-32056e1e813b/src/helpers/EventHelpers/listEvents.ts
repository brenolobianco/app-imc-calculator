import { DateInterval } from '../../interfaces';
import { listEventsPaginated } from '../../services/EventServices';
import {
  EventFilter,
  MyObject,
  ListEventsParams,
  ListEventsResponse,
  ID,
} from '../../types';
import { createFilterQuery } from '../../utils/filter';
import { createSearchQuery } from '../../utils/search';

// eslint-disable-next-line max-lines-per-function
async function createListEventsConditions(
  q: string,
  filters: EventFilter,
): Promise<MyObject> {
  const [search, filter] = await Promise.all([
    createSearchQuery(['title'])(q),
    createFilterQuery([
      {
        type: 'dateInterval',
        name: 'beginDate',
        value: filters.dateInterval as DateInterval,
      },
      {
        type: 'boolean',
        name: 'isPending',
        value: filters.isPending as boolean,
      },
      { type: 'id', name: 'order', value: filters.order as ID },
      { type: 'id', name: 'client', value: filters.client as ID },
      { type: 'id', name: 'employees', value: filters.employee as ID },
    ]),
  ]);

  return { ...search, ...filter };
}

export async function listEvents({
  q,
  sort,
  page,
  perPage,
  ...filters
}: ListEventsParams): Promise<ListEventsResponse> {
  const conditions = await createListEventsConditions(q as string, filters);

  const { objects: events, total, pages } = await listEventsPaginated({
    conditions,
    page,
    perPage,
    sort,
  });

  return { events, total, pages };
}
