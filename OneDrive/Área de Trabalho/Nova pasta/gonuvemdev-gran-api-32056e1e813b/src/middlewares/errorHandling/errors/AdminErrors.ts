import { createError } from './utils';

/* Model Admin 710 - 719 */
export const ADMINS_EMPTY_LIST = createError({
  message: 'Nenhum administrador encontrado',
  statusCode: 404,
  internalCode: 710,
});

export const ADMIN_NOT_FOUND = createError({
  message: 'Administrador não encontrado',
  statusCode: 404,
  internalCode: 711,
});

export const ADMIN_IN_USE = createError({
  message:
    'Esse administrador não pode ser deletado pois está em uso por outros objetos',
  statusCode: 422,
  internalCode: 712,
});
