import { createError } from './utils';

/* Model Finish 730 - 739 */
export const FINISHES_EMPTY_LIST = createError({
  message: 'Nenhum acabamento encontrado',
  statusCode: 404,
  internalCode: 730,
});

export const FINISH_NOT_FOUND = createError({
  message: 'Acabamento não encontrado',
  statusCode: 404,
  internalCode: 731,
});

export const FINISH_CODE_CONFLICT = createError({
  message: 'Já existe um acabamento com este código',
  statusCode: 409,
  internalCode: 732,
});

export const FINISH_IN_USE = createError({
  message:
    'Esse acabamento não pode ser deletado pois está em uso por outros objetos',
  statusCode: 422,
  internalCode: 733,
});
