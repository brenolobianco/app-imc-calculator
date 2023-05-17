import { CreateAdminInput } from '../../types';
import { AdminDocument, AdminInterface, UserInterface } from '../../interfaces';
import { Role } from '../../enums';
import {
  createOneUserObject,
  checkUserConflicts,
} from '../../services/UserServices';
import { createOneAdminObject } from '../../services/AdminServices';
import { fetchOneEmployee } from '../../services/EmployeeServices';

// eslint-disable-next-line max-lines-per-function
const createAdminWithUser = async (
  adminData: Partial<AdminInterface>,
  userData: Partial<UserInterface>,
): Promise<AdminDocument> => {
  const userObject = createOneUserObject({ doc: userData });

  const adminObject = createOneAdminObject({
    doc: { user: userObject._id, ...adminData },
  });

  const [admin, user] = await Promise.all([
    adminObject.save(),
    userObject.save(),
  ]);

  admin.user = user;

  return admin;
};

export async function createAdmin(
  input: CreateAdminInput,
): Promise<{ admin: AdminDocument }> {
  const { employee: employeeId, ...userData } = input;

  const fetchEmployeePromise = employeeId
    ? fetchOneEmployee({ conditions: { _id: employeeId } })
    : Promise.resolve(null);

  const [, employee] = await Promise.all([
    checkUserConflicts(userData),
    fetchEmployeePromise,
  ]);

  const adminData = employee ? { employee: employee._id } : {};

  const admin = await createAdminWithUser(adminData, userData);

  return { admin };
}
