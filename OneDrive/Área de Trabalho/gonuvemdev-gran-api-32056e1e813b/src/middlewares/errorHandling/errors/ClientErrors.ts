import { createError } from './utils';

/* Model Client 750 - 759 */
export const CLIENTS_EMPTY_LIST = createError({
  message: 'Nenhum cliente encontrado',
  statusCode: 404,
  internalCode: 750,
});

export const CLIENT_NOT_FOUND = createError({
  message: 'Cliente não encontrado',
  statusCode: 404,
  internalCode: 751,
});

export const CLIENT_PRIMARY_PHONE_CONFLICT = createError({
  message: 'Já existe um cliente com este telefone principal',
  statusCode: 409,
  internalCode: 752,
});

export const CLIENT_IN_USE = createError({
  message:
    'Esse cliente não pode ser deletado pois está em uso por outros objetos',
  statusCode: 422,
  internalCode: 753,
});
