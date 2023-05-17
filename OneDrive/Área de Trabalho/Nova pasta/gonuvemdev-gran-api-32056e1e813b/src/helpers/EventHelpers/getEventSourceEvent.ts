import { EventDocument } from '../../interfaces';
import { fetchOneEventWithoutError } from '../../services/EventServices';

export async function getEventSourceEvent(
  event: EventDocument,
): Promise<ReturnType<typeof fetchOneEventWithoutError>> {
  return fetchOneEventWithoutError({
    conditions: { _id: event.sourceEvent },
  });
}
