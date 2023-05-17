import { OrderDocument } from '../../interfaces';
import { fetchOneEmployeeWithoutError } from '../../services/EmployeeServices';

export async function getOrderIntermediator(
  order: OrderDocument,
): Promise<ReturnType<typeof fetchOneEmployeeWithoutError>> {
  return fetchOneEmployeeWithoutError({
    conditions: { _id: order.intermediator },
  });
}
