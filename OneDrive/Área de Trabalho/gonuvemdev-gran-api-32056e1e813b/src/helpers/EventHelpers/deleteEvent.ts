import {
  fetchOneEvent,
  deleteOneEvent,
  checkEventInUse,
} from '../../services/EventServices';
import { MyObject } from '../../types';

export async function deleteEvent({ id }: { id: string }): Promise<MyObject> {
  const event = await fetchOneEvent({ conditions: { _id: id } });

  /** Verificar se está em uso por outros objetos */
  await checkEventInUse({ id: event._id });

  await deleteOneEvent({ conditions: { _id: event._id } });

  return {};
}
