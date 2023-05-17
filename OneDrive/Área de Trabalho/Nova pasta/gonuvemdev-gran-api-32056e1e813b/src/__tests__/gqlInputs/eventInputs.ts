import { CreateEventInput, ID, UpdateEventInput } from '../../types';
import { createArrayInput, createStringValue } from '../gqlTestHelper';

export const createInputCreateEvent = (input: CreateEventInput): string => `{
  title: "${input.title}",
  beginDate: "${input.beginDate.toISOString()}",
  endDate: "${input.endDate?.toISOString()}",
  duration: ${input.duration},
  isPending: ${input.isPending},
  sourceEvent: "${input.sourceEvent}",
  order: "${input.order}",
  client: "${input.client}",
  employees: ${createArrayInput(input.employees as ID[], createStringValue)},
  color: "${input.color}",
}`;

export function createInputUpdateEvent(
  input: Required<UpdateEventInput>,
): string {
  return createInputCreateEvent(input);
}
