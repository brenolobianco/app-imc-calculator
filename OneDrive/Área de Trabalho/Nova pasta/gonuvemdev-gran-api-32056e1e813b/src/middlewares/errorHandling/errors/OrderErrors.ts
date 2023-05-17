import { createError } from './utils';

/* Model Order 760 - 769 */
export const ORDERS_EMPTY_LIST = createError({
  message: 'Nenhum pedido encontrado',
  statusCode: 404,
  internalCode: 760,
});

export const ORDER_NOT_FOUND = createError({
  message: 'Pedido não encontrado',
  statusCode: 404,
  internalCode: 761,
});

export const ORDER_TYPE_CANNOT_BE_CHANGED_TO_BUDGET = createError({
  message: 'Não é possível transformar um Pedido em Orçamento',
  statusCode: 422,
  internalCode: 762,
});

export const ORDER_IN_USE = createError({
  message:
    'Esse pedido não pode ser deletado pois está em uso por outros objetos',
  statusCode: 422,
  internalCode: 763,
});
