import { listProductsPaginated } from '../../services/ProductServices';
import { createSearchQuery } from '../../utils/search';
import {
  ListProductsParams,
  ListProductsResponse,
  MyObject,
  ProductFilter,
} from '../../types';
import { createFilterQuery } from '../../utils/filter';

// eslint-disable-next-line max-lines-per-function
async function createListProductsConditions(
  q: string,
  filters: ProductFilter,
): Promise<MyObject> {
  const [search, filter] = await Promise.all([
    createSearchQuery(['name'])(q),
    createFilterQuery([
      {
        type: 'boolean',
        name: 'isActivated',
        value: filters.isActivated as boolean,
      },
      {
        type: 'string',
        name: 'type',
        value: filters.type as string,
      },
    ]),
  ]);

  return { ...search, ...filter };
}

export async function listProducts({
  q,
  sort,
  page,
  perPage,
  ...filters
}: ListProductsParams): Promise<ListProductsResponse> {
  const conditions = await createListProductsConditions(q as string, filters);

  const { objects: products, total, pages } = await listProductsPaginated({
    conditions,
    page,
    perPage,
    sort,
  });

  return { products, total, pages };
}
