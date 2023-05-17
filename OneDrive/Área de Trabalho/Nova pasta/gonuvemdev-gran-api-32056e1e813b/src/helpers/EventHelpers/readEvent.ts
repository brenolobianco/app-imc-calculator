import { EventDoc } from '../../interfaces';
import { fetchOneEvent } from '../../services/EventServices';

export async function readEvent({
  id,
}: {
  id: string;
}): Promise<{ event: EventDoc }> {
  const event = await fetchOneEvent({ conditions: { _id: id } });

  return { event };
}
