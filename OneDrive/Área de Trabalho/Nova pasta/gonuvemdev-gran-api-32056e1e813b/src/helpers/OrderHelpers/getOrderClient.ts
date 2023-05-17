import { OrderDocument } from '../../interfaces';
import { fetchOneClientWithoutError } from '../../services/ClientServices';

export async function getOrderClient(
  order: OrderDocument,
): Promise<ReturnType<typeof fetchOneClientWithoutError>> {
  return fetchOneClientWithoutError({
    conditions: { _id: order.client },
  });
}
