import { EventDocument } from '../../interfaces';
import { fetchOneOrderWithoutError } from '../../services/OrderServices';

export async function getEventOrder(
  event: EventDocument,
): Promise<ReturnType<typeof fetchOneOrderWithoutError>> {
  return fetchOneOrderWithoutError({
    conditions: { _id: event.order },
  });
}
