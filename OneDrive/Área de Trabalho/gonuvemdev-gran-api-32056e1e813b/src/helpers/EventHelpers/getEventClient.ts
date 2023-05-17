import { EventDocument } from '../../interfaces';
import { fetchOneClientWithoutError } from '../../services/ClientServices';

export async function getEventClient(
  event: EventDocument,
): Promise<ReturnType<typeof fetchOneClientWithoutError>> {
  return fetchOneClientWithoutError({
    conditions: { _id: event.client },
  });
}
