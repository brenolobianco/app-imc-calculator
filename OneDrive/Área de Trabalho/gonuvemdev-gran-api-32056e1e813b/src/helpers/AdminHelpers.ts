import { ID, MyObject } from '../types';
import {
  UserDocument,
  AdminInterface,
  UserInterface,
  AdminDoc,
} from '../interfaces';
import { updateOneAdmin, fetchOneAdmin } from '../services/AdminServices';
import { updateOneUser, checkUserConflicts } from '../services/UserServices';
import { fetchOneEmployee } from '../services/EmployeeServices';

export const updateAdminWithUser = async (
  admin: AdminDoc,
  adminData: Partial<AdminInterface>,
  userData: Partial<UserInterface>,
): Promise<AdminDoc> => {
  const [adminUpdated, user] = await Promise.all([
    updateOneAdmin({
      conditions: { _id: admin._id },
      updateData: adminData,
    }),
    updateOneUser({
      conditions: { _id: (admin.user as UserDocument)._id },
      updateData: userData,
    }),
  ]);

  adminUpdated.user = user;

  return adminUpdated;
};

// eslint-disable-next-line max-lines-per-function
export const fetchAndUpdateAdminWithUser = async (
  conditions: MyObject,
  updateData: Partial<AdminInterface & UserInterface>,
): Promise<AdminDoc> => {
  const { employee: employeeId, ...userData } = updateData;

  const admin = await fetchOneAdmin({ conditions });

  const checkConflictsPromise = userData.email
    ? checkUserConflicts(userData, admin.user as ID)
    : Promise.resolve(null);

  const fetchEmployeePromise = employeeId
    ? fetchOneEmployee({ conditions: { _id: employeeId } })
    : Promise.resolve(null);

  const [, employee] = await Promise.all([
    checkConflictsPromise,
    fetchEmployeePromise,
  ]);

  const adminData = employee ? { employee: employee._id } : {};

  return updateAdminWithUser(admin, adminData, userData);
};
