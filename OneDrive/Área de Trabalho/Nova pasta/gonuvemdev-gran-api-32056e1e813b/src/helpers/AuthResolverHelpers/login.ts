import { fetchOneUser } from '../../services/UserServices';
import { createToken } from '../../middlewares/authentication/authenticationHelper';
import { EmployeeDocument, UserDoc, UserDocument } from '../../interfaces';
import Admin from '../../models/Admin';
import { Role } from '../../enums';
import { LoginResponse, LoginParams, UserRoleInfo, ID } from '../../types';
import { checkIfPasswordIsCorrect } from '../UserHelpers';

async function getAdminRoleInfo(userId: ID) {
  const admin = await Admin.findOne({ user: userId })
    .populate('user', '-password -renewPasswordCode')
    .populate('employee', 'commission name')
    .lean();

  const employee = admin?.employee as EmployeeDocument;

  return {
    _id: admin?._id,
    user: admin?.user as UserDocument,
    commission: employee?.commission,
    employeeName: employee?.name,
  };
}

const getUserRoleInfo = async (user: UserDoc): Promise<UserRoleInfo | null> => {
  const role = user.roles[0];

  const { password, ...userData } = user;

  switch (role) {
    case Role.Dev:
      return { _id: undefined, user: userData };
    case Role.Admin:
      return getAdminRoleInfo(user._id);
    default:
      return { _id: undefined, user: userData };
  }
};

export async function login({
  email,
  password,
}: LoginParams): Promise<LoginResponse> {
  const user = await fetchOneUser({
    conditions: { email },
    projection: '-renewPasswordCode',
  });

  await checkIfPasswordIsCorrect(user, password);

  const [token, info] = await Promise.all([
    createToken(user._id),
    getUserRoleInfo(user),
  ]);

  return { token, info };
}
