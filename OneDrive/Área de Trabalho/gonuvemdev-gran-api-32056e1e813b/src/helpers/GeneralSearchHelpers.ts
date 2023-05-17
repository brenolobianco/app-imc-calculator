import { Role } from '../enums';
import { fetchAllAdmins } from '../services/AdminServices';
import { fetchAllClients } from '../services/ClientServices';
import { fetchAllEmployees } from '../services/EmployeeServices';
import { fetchAllFinishes } from '../services/FinishServices';
import { fetchAllOrders } from '../services/OrderServices';
import { fetchAllProducts } from '../services/ProductServices';
import { fetchAllUsers } from '../services/UserServices';
import {
  GeneralSearchParams,
  GeneralSearchResponse,
  ID,
  MyObject,
} from '../types';
import { createArrayFilter } from '../utils/filter';
import { createSearchQuery } from '../utils/search';

async function getSellers(q: string) {
  const userSearch = await createSearchQuery(['name', 'email'])(q);

  const userConditions = { roles: [Role.Admin], ...userSearch };

  const adminUsers = await fetchAllUsers({ conditions: userConditions });

  const adminsUserId = adminUsers.map(e => e._id);

  const search = { user: { $in: adminsUserId } };

  return fetchAllAdmins({ conditions: search, projection: 'user' });
}

async function getClients(q: string) {
  const search = await createSearchQuery([
    'name',
    'primaryPhone',
    'secondaryPhones',
  ])(q);

  return fetchAllClients({ conditions: search }).limit(10);
}

async function getIntermediators(q: string) {
  const search = await createSearchQuery(['name', 'cpf'])(q);

  return fetchAllEmployees({ conditions: search, projection: 'name cpf' });
}

async function getFinishes(q: string) {
  const search = await createSearchQuery(['code'])(q);

  return fetchAllFinishes({ conditions: search, projection: 'code' });
}

async function getProducts(q: string) {
  const search = await createSearchQuery(['name'])(q);

  return fetchAllProducts({ conditions: search, projection: 'name' });
}

async function getBudgets(search: MyObject) {
  return fetchAllOrders({ conditions: { ...search, type: 'budget' } }).limit(
    10,
  );
}

// eslint-disable-next-line max-lines-per-function
async function createBudgetsConditions(
  q: string,
  params: {
    sellersIds: ID[];
    clientsIds: ID[];
    intermediatorsIds: ID[];
    finishesIds: ID[];
    productsIds: ID[];
  },
) {
  const createFilter = (name: string, value: unknown[]) => {
    return createArrayFilter({ name, type: 'list', value });
  };

  const names = [
    'seller',
    'client',
    'intermediator',
    'items.finish',
    'items.product',
  ];

  const filters = Object.entries(params)
    .map(([, value], i) => createFilter(names[i], value))
    .filter(filter => Object.keys(filter).length > 0);

  const { $or } = await createSearchQuery(['code'])(q);

  return { $or: [...($or as unknown[]), ...filters] };
}

// eslint-disable-next-line max-lines-per-function
export async function generalSearch({
  q,
}: GeneralSearchParams): Promise<GeneralSearchResponse> {
  const [
    sellers,
    clients,
    intermediators,
    finishes,
    products,
  ] = await Promise.all([
    getSellers(q),
    getClients(q),
    getIntermediators(q),
    getFinishes(q),
    getProducts(q),
  ]);

  const budgetsConditions = await createBudgetsConditions(q, {
    sellersIds: sellers.map(({ _id }) => _id),
    clientsIds: clients.map(({ _id }) => _id),
    intermediatorsIds: intermediators.map(({ _id }) => _id),
    finishesIds: finishes.map(({ _id }) => _id),
    productsIds: products.map(({ _id }) => _id),
  });

  const budgets = await getBudgets(budgetsConditions);

  return { budgets, clients };
}
