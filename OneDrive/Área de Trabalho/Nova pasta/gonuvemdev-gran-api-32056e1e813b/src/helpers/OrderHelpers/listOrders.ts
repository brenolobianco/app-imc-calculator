/* eslint-disable max-lines-per-function */
import { OrderStatus } from '../../enums';
import { ListPaginatedParams, OrderDocument } from '../../interfaces';
import { ORDERS_EMPTY_LIST } from '../../middlewares/errorHandling/errors';
import Order from '../../models/Order';
import { listOrdersPaginated } from '../../services/OrderServices';
import {
  OrderFilter,
  MyObject,
  ListOrdersParams,
  ListOrdersResponse,
  ID,
} from '../../types';
import { createFilterQuery } from '../../utils/filter';
import { isEmptyArray } from '../../utils/general';
import { createSearchQuery } from '../../utils/search';

// eslint-disable-next-line max-lines-per-function
async function createListOrdersConditions(
  q: string,
  filters: OrderFilter,
): Promise<MyObject> {
  const [search, filter] = await Promise.all([
    createSearchQuery(['code'])(q),
    createFilterQuery([
      { type: 'id', name: 'client', value: filters.client as ID },
      { type: 'id', name: 'seller', value: filters.seller as ID },
      { type: 'id', name: 'intermediator', value: filters.intermediator as ID },
      {
        type: 'string',
        name: 'type',
        value: filters.type as 'budger' | 'order',
      },
      { type: 'string', name: 'status', value: filters.status as OrderStatus },
      {
        type: 'boolean',
        name: 'payment.paid',
        value: filters.paymentPaid as boolean,
      },
    ]),
  ]);

  return { ...search, ...filter };
}

// eslint-disable-next-line max-lines-per-function
async function listOrdersPaginatedSortedByCode({
  conditions,
  page = 0,
  perPage = 5,
  sort,
  projection,
}: ListPaginatedParams) {
  const [total, objects] = await Promise.all<number, OrderDocument[]>([
    Order.find(conditions, projection).lean().countDocuments(),
    Order.find(conditions, projection)
      .sort(sort)
      .collation({ locale: 'pt', numericOrdering: true })
      .skip(page * perPage)
      .limit(perPage)
      .lean(),
  ]);

  if (isEmptyArray(objects)) throw ORDERS_EMPTY_LIST;

  const pages = Math.ceil(total / perPage);

  return { objects, total, pages };
}

async function listOrdersPaginatedBySortMethod(params: ListPaginatedParams) {
  if (params.sort === 'code' || params.sort === '-code') {
    return listOrdersPaginatedSortedByCode(params);
  }

  return listOrdersPaginated(params);
}

export async function listOrders({
  q,
  sort,
  page,
  perPage,
  ...filters
}: ListOrdersParams): Promise<ListOrdersResponse> {
  const conditions = await createListOrdersConditions(q as string, filters);

  const {
    objects: orders,
    total,
    pages,
  } = await listOrdersPaginatedBySortMethod({
    conditions,
    page,
    perPage,
    sort,
  });

  return { orders, total, pages };
}
