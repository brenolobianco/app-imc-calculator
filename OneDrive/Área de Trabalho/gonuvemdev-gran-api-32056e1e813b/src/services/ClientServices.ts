import Client from '../models/Client';
import {
  createOne,
  listPaginated,
  fetchOne,
  updateOne,
  deleteOne,
  checkConflicts,
  fetchOneWithoutError,
  checkInUse,
  checkIfExists,
  countTotal,
  countByCriteria,
  fetchAll,
} from '../utils/mongoose';
import {
  CLIENTS_EMPTY_LIST,
  CLIENT_IN_USE,
  CLIENT_NOT_FOUND,
  CLIENT_PRIMARY_PHONE_CONFLICT,
} from '../middlewares/errorHandling/errors';
import Order from '../models/Order';

export const createOneClient = createOne(Client);

export const listClientsPaginated = listPaginated(Client, CLIENTS_EMPTY_LIST);

export const fetchOneClient = fetchOne(Client, CLIENT_NOT_FOUND);

export const updateOneClient = updateOne(Client, CLIENT_NOT_FOUND);

export const deleteOneClient = deleteOne(Client, CLIENT_NOT_FOUND);

export const checkClientConflicts = checkConflicts(Client, [
  {
    fieldName: 'primaryPhone',
    error: CLIENT_PRIMARY_PHONE_CONFLICT,
  },
]);

export const fetchOneClientWithoutError = fetchOneWithoutError(Client);

export const checkClientInUse = checkInUse(
  [{ Model: Order, fieldName: 'client' }],
  CLIENT_IN_USE,
);

export const checkIfClientsExists = checkIfExists(Client, CLIENT_NOT_FOUND);

export const countClientsTotal = countTotal(Client);

export const countClientsByCriteria = countByCriteria(Client);

export const fetchAllClients = fetchAll(Client);
