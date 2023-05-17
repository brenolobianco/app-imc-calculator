import { createError } from './utils';

/* Model Event 770 - 779 */
export const EVENTS_EMPTY_LIST = createError({
  message: 'Nenhum evento encontrado',
  statusCode: 404,
  internalCode: 770,
});

export const EVENT_NOT_FOUND = createError({
  message: 'Evento não encontrado',
  statusCode: 404,
  internalCode: 771,
});

export const EVENT_IN_USE = createError({
  message:
    'Esse evento não pode ser deletado pois está em uso por outros objetos',
  statusCode: 422,
  internalCode: 772,
});
