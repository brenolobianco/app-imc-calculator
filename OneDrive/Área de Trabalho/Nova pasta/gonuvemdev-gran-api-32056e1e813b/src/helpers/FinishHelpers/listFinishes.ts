import { listFinishesPaginated } from '../../services/FinishServices';
import { createSearchQuery } from '../../utils/search';
import {
  ListFinishesParams,
  ListFinishesResponse,
  MyObject,
} from '../../types';

async function createListFinishesConditions(q: string): Promise<MyObject> {
  const search = await createSearchQuery(['code'])(q);

  return { ...search };
}

export async function listFinishes({
  q,
  sort,
  page,
  perPage,
}: ListFinishesParams): Promise<ListFinishesResponse> {
  const conditions = await createListFinishesConditions(q as string);

  const { objects: finishes, total, pages } = await listFinishesPaginated({
    conditions,
    page,
    perPage,
    sort,
  });

  return { finishes, total, pages };
}
