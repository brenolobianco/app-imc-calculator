import Employee from '../models/Employee';
import {
  createOne,
  fetchOne,
  updateOne,
  deleteOne,
  listPaginated,
  fetchOneWithoutError,
  checkInUse,
  checkIfExists,
  fetchAll,
  countTotal,
} from '../utils/mongoose';
import {
  EMPLOYEES_EMPTY_LIST,
  EMPLOYEE_NOT_FOUND,
  EMPLOYEE_IN_USE,
} from '../middlewares/errorHandling/errors';
import Admin from '../models/Admin';
import Order from '../models/Order';

export const createOneEmployee = createOne(Employee);

export const listEmployeesPaginated = listPaginated(
  Employee,
  EMPLOYEES_EMPTY_LIST,
);

export const fetchOneEmployee = fetchOne(Employee, EMPLOYEE_NOT_FOUND);

export const updateOneEmployee = updateOne(Employee, EMPLOYEE_NOT_FOUND);

export const deleteOneEmployee = deleteOne(Employee, EMPLOYEE_NOT_FOUND);

export const fetchOneEmployeeWithoutError = fetchOneWithoutError(Employee);

export const checkEmployeeInUse = checkInUse(
  [
    { Model: Admin, fieldName: 'employee' },
    { Model: Order, fieldName: 'intermediator' },
  ],
  EMPLOYEE_IN_USE,
);

export const checkIfEmployeesExists = checkIfExists(
  Employee,
  EMPLOYEE_NOT_FOUND,
);

export const fetchAllEmployees = fetchAll(Employee);

export const countEmployeesTotal = countTotal(Employee);
