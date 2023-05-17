import { OrderDocument } from '../../interfaces';
import { fetchOneAdminWithoutError } from '../../services/AdminServices';

export async function getOrderSeller(
  order: OrderDocument,
): Promise<ReturnType<typeof fetchOneAdminWithoutError>> {
  return fetchOneAdminWithoutError({
    conditions: { _id: order.seller },
  });
}
