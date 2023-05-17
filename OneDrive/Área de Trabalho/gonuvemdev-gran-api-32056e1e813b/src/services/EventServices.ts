import Event from '../models/Event';
import {
  createOne,
  listPaginated,
  fetchOne,
  updateOne,
  deleteOne,
  checkIfExists,
  checkInUse,
  fetchOneWithoutError,
  countTotal,
} from '../utils/mongoose';
import {
  EVENTS_EMPTY_LIST,
  EVENT_IN_USE,
  EVENT_NOT_FOUND,
} from '../middlewares/errorHandling/errors';

export const createOneEvent = createOne(Event);

export const listEventsPaginated = listPaginated(Event, EVENTS_EMPTY_LIST);

export const fetchOneEvent = fetchOne(Event, EVENT_NOT_FOUND);

export const updateOneEvent = updateOne(Event, EVENT_NOT_FOUND);

export const deleteOneEvent = deleteOne(Event, EVENT_NOT_FOUND);

export const checkIfEventsExists = checkIfExists(Event, EVENT_NOT_FOUND);

export const checkEventInUse = checkInUse(
  [{ Model: Event, fieldName: 'sourceEvent' }],
  EVENT_IN_USE,
);

export const fetchOneEventWithoutError = fetchOneWithoutError(Event);

export const countEventsTotal = countTotal(Event);
