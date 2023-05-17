import {
  fetchOneAdmin,
  deleteOneAdmin,
  checkAdminInUse,
} from '../../services/AdminServices';
import { deleteOneUser } from '../../services/UserServices';
import { UserDocument } from '../../interfaces';
import { MyObject } from '../../types';

export async function deleteAdmin({ id }: { id: string }): Promise<MyObject> {
  const admin = await fetchOneAdmin({ conditions: { _id: id } });

  await checkAdminInUse({ id: admin._id });

  await Promise.all([
    deleteOneAdmin({ conditions: { _id: admin._id } }),
    deleteOneUser({ conditions: { _id: (admin.user as UserDocument)._id } }),
  ]);

  return {};
}
