import { EventDocument } from '../../interfaces';
import { checkIfClientsExists } from '../../services/ClientServices';
import { checkIfEmployeesExists } from '../../services/EmployeeServices';
import {
  createOneEvent,
  checkIfEventsExists,
} from '../../services/EventServices';
import { checkIfOrdersExists } from '../../services/OrderServices';
import { CreateEventInput } from '../../types';

async function checkReferences(input: CreateEventInput) {
  const { sourceEvent, order, client, employees } = input;

  await Promise.all([
    sourceEvent ? checkIfEventsExists([sourceEvent]) : null,
    order ? checkIfOrdersExists([order]) : null,
    client ? checkIfClientsExists([client]) : null,
    employees ? checkIfEmployeesExists(employees) : null,
  ]);
}

export async function createEvent(
  input: CreateEventInput,
): Promise<{ event: EventDocument }> {
  await checkReferences(input);

  const event = await createOneEvent({ doc: input });

  return { event };
}
