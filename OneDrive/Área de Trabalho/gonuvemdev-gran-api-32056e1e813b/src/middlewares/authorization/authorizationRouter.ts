import { Role } from '../../enums';

/**
 * Determina os papéis que podem acessar uma operação grapqhl
 * @example { createUser: [Role.Dev, Role.Admin] }
 */
export const gqlRouter: { [resolverName: string]: Role[] } = {
  readOwnProfile: [Role.Admin],
  updateOwnProfile: [Role.Admin],

  createAdmin: [Role.Dev, Role.Admin],
  updateAdmin: [Role.Dev, Role.Admin],
  deleteAdmin: [Role.Dev, Role.Admin],
  listAdmins: [Role.Dev, Role.Admin],
  readAdmin: [Role.Dev, Role.Admin],

  createEmployee: [Role.Dev, Role.Admin],
  updateEmployee: [Role.Dev, Role.Admin],
  deleteEmployee: [Role.Dev, Role.Admin],
  listEmployees: [Role.Dev, Role.Admin],
  readEmployee: [Role.Dev, Role.Admin],
  listEmployeesOccupations: [Role.Dev, Role.Admin],

  createFinish: [Role.Dev, Role.Admin],
  updateFinish: [Role.Dev, Role.Admin],
  deleteFinish: [Role.Dev, Role.Admin],
  listFinishes: [Role.Dev, Role.Admin],
  readFinish: [Role.Dev, Role.Admin],

  createProduct: [Role.Dev, Role.Admin],
  updateProduct: [Role.Dev, Role.Admin],
  deleteProduct: [Role.Dev, Role.Admin],
  listProducts: [Role.Dev, Role.Admin],
  readProduct: [Role.Dev, Role.Admin],
  updateProductPrices: [Role.Dev, Role.Admin],

  createClient: [Role.Admin],
  updateClient: [Role.Dev, Role.Admin],
  deleteClient: [Role.Dev, Role.Admin],
  listClients: [Role.Dev, Role.Admin],
  readClient: [Role.Dev, Role.Admin],

  createOrder: [Role.Admin],
  listOrders: [Role.Dev, Role.Admin],
  readOrder: [Role.Dev, Role.Admin],
  updateOrder: [Role.Dev, Role.Admin],
  deleteOrder: [Role.Dev, Role.Admin],
  duplicateBudget: [Role.Dev, Role.Admin],

  createEvent: [Role.Dev, Role.Admin],
  updateEvent: [Role.Dev, Role.Admin],
  deleteEvent: [Role.Dev, Role.Admin],
  listEvents: [Role.Dev, Role.Admin],
  readEvent: [Role.Dev, Role.Admin],

  getBusinessStatistics: [Role.Dev, Role.Admin],
  getReportData: [Role.Dev, Role.Admin],

  generalSearch: [Role.Dev, Role.Admin],
};

export const restRouter: { [route: string]: Role[] } = {
  'GET /budgets/generate_pdf_files': [Role.Dev, Role.Admin],
  'GET /budgets/generate_pdf_buffers': [Role.Dev, Role.Admin],

  'GET /agreements/:id/generate_pdf_file': [Role.Dev, Role.Admin],
};
