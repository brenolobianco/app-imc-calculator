import { createError } from './utils';

/* Model Employee 720 - 729 */
export const EMPLOYEES_EMPTY_LIST = createError({
  message: 'Nenhum funcionário encontrado',
  statusCode: 404,
  internalCode: 720,
});

export const EMPLOYEE_NOT_FOUND = createError({
  message: 'Funcionário não encontrado',
  statusCode: 404,
  internalCode: 721,
});

export const EMPLOYEE_IN_USE = createError({
  message:
    'Esse funcionário não pode ser deletado pois está em uso por outros objetos',
  statusCode: 422,
  internalCode: 722,
});
