import { wrapGqlAsyncFunc } from '../../middlewares/errorHandling/errorHandlingHelpers';
import validateGqlRequest from '../../middlewares/validation';
import isGqlAuthenticated from '../../middlewares/authentication';
import isGqlAuthorized from '../../middlewares/authorization';
import * as EmployeeResolverHelpers from '../../helpers/EmployeeResolverHelpers';
import {
  MyContext,
  CreateEmployeeInput,
  UpdateEmployeeInput,
  ListEmployeesParams,
  ListEmployeesResponse,
  MyObject,
} from '../../types';
import { EmployeeDoc, EmployeeDocument } from '../../interfaces';

function createEmployee(
  _parent: unknown,
  _args: unknown,
  context: MyContext<{ input: CreateEmployeeInput }>,
): Promise<{ employee: EmployeeDocument }> {
  return EmployeeResolverHelpers.createEmployee(context.validData.input);
}

function updateEmployee(
  _parent: unknown,
  _args: unknown,
  context: MyContext<{ id: string; input: UpdateEmployeeInput }>,
): Promise<{ employee: EmployeeDoc }> {
  return EmployeeResolverHelpers.updateEmployee(context.validData);
}

function deleteEmployee(
  _parent: unknown,
  _args: unknown,
  context: MyContext<{ id: string }>,
): Promise<MyObject> {
  return EmployeeResolverHelpers.deleteEmployee(context.validData);
}

function listEmployees(
  _parent: unknown,
  _args: unknown,
  context: MyContext<ListEmployeesParams>,
): Promise<ListEmployeesResponse> {
  return EmployeeResolverHelpers.listEmployees(context.validData);
}

function readEmployee(
  _parent: unknown,
  _args: unknown,
  context: MyContext<{ id: string }>,
): Promise<{ employee: EmployeeDoc }> {
  return EmployeeResolverHelpers.readEmployee(context.validData);
}

function listEmployeesOccupations(
  _parent: unknown,
  _args: unknown,
  _context: MyContext,
) {
  return EmployeeResolverHelpers.listEmployeesOccupations();
}

export const Query = {
  listEmployees: wrapGqlAsyncFunc(
    isGqlAuthenticated(isGqlAuthorized(validateGqlRequest(listEmployees))),
  ),
  readEmployee: wrapGqlAsyncFunc(
    isGqlAuthenticated(isGqlAuthorized(validateGqlRequest(readEmployee))),
  ),
  listEmployeesOccupations: wrapGqlAsyncFunc(
    isGqlAuthenticated(isGqlAuthorized(listEmployeesOccupations)),
  ),
};

export const Mutation = {
  createEmployee: wrapGqlAsyncFunc(
    isGqlAuthenticated(isGqlAuthorized(validateGqlRequest(createEmployee))),
  ),
  updateEmployee: wrapGqlAsyncFunc(
    isGqlAuthenticated(isGqlAuthorized(validateGqlRequest(updateEmployee))),
  ),
  deleteEmployee: wrapGqlAsyncFunc(
    isGqlAuthenticated(isGqlAuthorized(validateGqlRequest(deleteEmployee))),
  ),
};
