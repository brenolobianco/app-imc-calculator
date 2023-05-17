import { Role } from '../../enums';
import { ListAdminsParams, ListAdminsResponse, MyObject } from '../../types';
import { listAdminsWithUserPaginated } from '../../services/AdminServices';
import { fetchAllUsers } from '../../services/UserServices';
import { createSearchQuery } from '../../utils/search';

const createListAdminsConditions = async (
  userSearch: MyObject,
  filter: MyObject,
): Promise<MyObject> => {
  const userConditions = { roles: [Role.Admin], ...userSearch };

  const adminUsers = await fetchAllUsers({ conditions: userConditions });

  const adminsUserId = adminUsers.map(e => e._id);

  return { user: { $in: adminsUserId }, ...filter };
};

export async function listAdmins({
  q,
  sort,
  page,
  perPage,
}: ListAdminsParams): Promise<ListAdminsResponse> {
  const userSearch = await createSearchQuery(['name', 'email'])(q);

  const conditions = await createListAdminsConditions(userSearch, {});

  const { objects: admins, total, pages } = await listAdminsWithUserPaginated(
    conditions,
    '',
    sort,
    page,
    perPage,
  );

  return { admins, total, pages };
}
