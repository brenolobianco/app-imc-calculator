import {
  fetchOneFinish,
  deleteOneFinish,
  checkFinishInUse,
} from '../../services/FinishServices';
import { MyObject } from '../../types';

export async function deleteFinish({ id }: { id: string }): Promise<MyObject> {
  const finish = await fetchOneFinish({ conditions: { _id: id } });

  await checkFinishInUse({ id: finish._id });

  await deleteOneFinish({ conditions: { _id: finish._id } });

  return {};
}
