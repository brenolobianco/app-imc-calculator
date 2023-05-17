import { EventDoc } from '../../interfaces';
import {
  fetchOneEvent,
  updateOneEvent,
  checkIfEventsExists,
} from '../../services/EventServices';
import { UpdateEventInput } from '../../types';
import { checkIfClientsExists } from '../../services/ClientServices';
import { checkIfEmployeesExists } from '../../services/EmployeeServices';
import { checkIfOrdersExists } from '../../services/OrderServices';

async function checkReferences(input: UpdateEventInput) {
  const { sourceEvent, order, client, employees } = input;

  await Promise.all([
    sourceEvent ? checkIfEventsExists([sourceEvent]) : null,
    order ? checkIfOrdersExists([order]) : null,
    client ? checkIfClientsExists([client]) : null,
    employees ? checkIfEmployeesExists(employees) : null,
  ]);
}

export async function updateEvent({
  id,
  input,
}: {
  id: string;
  input: UpdateEventInput;
}): Promise<{ event: EventDoc }> {
  const event = await fetchOneEvent({ conditions: { _id: id } });

  /** Verificar referências */
  await checkReferences(input);

  const eventUpdated = await updateOneEvent({
    conditions: { _id: event._id },
    updateData: input,
  });

  return { event: eventUpdated };
}
