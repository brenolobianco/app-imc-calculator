import { fetchOneFinish } from '../../services/FinishServices';
import { FinishDoc } from '../../interfaces';

export async function readFinish({
  id,
}: {
  id: string;
}): Promise<{ finish: FinishDoc }> {
  const finish = await fetchOneFinish({ conditions: { _id: id } });

  return { finish };
}
