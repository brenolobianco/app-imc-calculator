import { createError } from './utils';

/* Model Product 740 - 749 */
export const PRODUCTS_EMPTY_LIST = createError({
  message: 'Nenhum produto encontrado',
  statusCode: 404,
  internalCode: 740,
});

export const PRODUCT_NOT_FOUND = createError({
  message: 'Produto não encontrado',
  statusCode: 404,
  internalCode: 741,
});

export const PRODUCT_IN_USE = createError({
  message:
    'Esse produto não pode ser deletado pois está em uso por outros objetos',
  statusCode: 422,
  internalCode: 742,
});
