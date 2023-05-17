import createAdminTest from './createAdminTest';
import updateAdminTest from './updateAdminTest';
import deleteAdminTest from './deleteAdminTest';
import listAdminsTest from './listAdminsTest';
import readAdminTest from './readAdminTest';

describe('Test Admin Resolvers', () => {
  describe('Test createAdmin', createAdminTest);

  describe('Test updateAdmin', updateAdminTest);

  describe('Test deleteAdmin', deleteAdminTest);

  describe('Test listAdmins', listAdminsTest);

  describe('Test readAdmin', readAdminTest);
});
