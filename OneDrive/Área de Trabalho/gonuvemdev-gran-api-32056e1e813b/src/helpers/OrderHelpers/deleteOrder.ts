import Event from '../../models/Event';
import { fetchOneOrder, deleteOneOrder } from '../../services/OrderServices';
import { ID, MyObject } from '../../types';

async function unlinkEventsFromThisOrder(orderId: ID): Promise<void> {
  await Event.updateMany({ order: orderId }, { order: undefined });
}

export async function deleteOrder({ id }: { id: string }): Promise<MyObject> {
  const order = await fetchOneOrder({ conditions: { _id: id } });

  await unlinkEventsFromThisOrder(order._id);

  await deleteOneOrder({ conditions: { _id: order._id } });

  return {};
}
