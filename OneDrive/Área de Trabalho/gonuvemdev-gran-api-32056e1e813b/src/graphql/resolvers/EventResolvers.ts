import { EventDocument, EventDoc, EmployeeDocument } from '../../interfaces';
import isGqlAuthenticated from '../../middlewares/authentication';
import isGqlAuthorized from '../../middlewares/authorization';
import { wrapGqlAsyncFunc } from '../../middlewares/errorHandling/errorHandlingHelpers';
import validateGqlRequest from '../../middlewares/validation';
import * as EventHelpers from '../../helpers/EventHelpers';
import {
  MyContext,
  CreateEventInput,
  UpdateEventInput,
  MyObject,
  ListEventsParams,
  ListEventsResponse,
  EventEmployeesDataLoader,
} from '../../types';

function createEvent(
  _parent: unknown,
  _args: unknown,
  context: MyContext<{ input: CreateEventInput }>,
): Promise<{ event: EventDocument }> {
  return EventHelpers.createEvent(context.validData.input);
}

function updateEvent(
  _parent: unknown,
  _args: unknown,
  context: MyContext<{ id: string; input: UpdateEventInput }>,
): Promise<{ event: EventDoc }> {
  return EventHelpers.updateEvent(context.validData);
}

function deleteEvent(
  _parent: unknown,
  _args: unknown,
  context: MyContext<{ id: string }>,
): Promise<MyObject> {
  return EventHelpers.deleteEvent(context.validData);
}

function listEvents(
  _parent: unknown,
  _args: unknown,
  context: MyContext<ListEventsParams>,
): Promise<ListEventsResponse> {
  return EventHelpers.listEvents(context.validData);
}

function readEvent(
  _parent: unknown,
  _args: unknown,
  context: MyContext<{ id: string }>,
): Promise<{ event: EventDoc }> {
  return EventHelpers.readEvent(context.validData);
}

function getEventEmployees(
  response: EventDocument,
  _args: unknown,
  context: MyContext<unknown, EventEmployeesDataLoader>,
): Promise<EmployeeDocument[]> {
  const { loaders } = context;

  const { eventEmployeesDataLoader } = loaders;

  return eventEmployeesDataLoader.load(response);
}

export const Query = {
  listEvents: wrapGqlAsyncFunc(
    isGqlAuthenticated(isGqlAuthorized(validateGqlRequest(listEvents))),
  ),
  readEvent: wrapGqlAsyncFunc(
    isGqlAuthenticated(isGqlAuthorized(validateGqlRequest(readEvent))),
  ),
};

export const Mutation = {
  createEvent: wrapGqlAsyncFunc(
    isGqlAuthenticated(isGqlAuthorized(validateGqlRequest(createEvent))),
  ),
  updateEvent: wrapGqlAsyncFunc(
    isGqlAuthenticated(isGqlAuthorized(validateGqlRequest(updateEvent))),
  ),
  deleteEvent: wrapGqlAsyncFunc(
    isGqlAuthenticated(isGqlAuthorized(validateGqlRequest(deleteEvent))),
  ),
};

export const references = {
  Event: {
    sourceEvent: EventHelpers.getEventSourceEvent,
    order: EventHelpers.getEventOrder,
    client: EventHelpers.getEventClient,
    employees: getEventEmployees,
  },
};
