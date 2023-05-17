import { OrderDoc } from '../../interfaces';
import { fetchOneOrder } from '../../services/OrderServices';

export async function readOrder({
  id,
}: {
  id: string;
}): Promise<{ order: OrderDoc }> {
  const order = await fetchOneOrder({ conditions: { _id: id } });

  return { order };
}
