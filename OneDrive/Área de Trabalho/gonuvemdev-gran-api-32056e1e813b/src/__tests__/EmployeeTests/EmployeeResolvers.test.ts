import createEmployeeTest from './createEmployeeTest';
import updateEmployeeTest from './updateEmployeeTest';
import deleteEmployeeTest from './deleteEmployeeTest';
import listEmployeesTest from './listEmployeesTest';
import readEmployeeTest from './readEmployeeTest';
import listEmployeesOccupationsTest from './listEmployeesOccupationsTest';

describe('Test Employee Resolvers', () => {
  describe('Test createEmployee', createEmployeeTest);

  describe('Test updateEmployee', updateEmployeeTest);

  describe('Test deleteEmployee', deleteEmployeeTest);

  describe('Test listEmployees', listEmployeesTest);

  describe('Test readEmployee', readEmployeeTest);

  describe('Test listEmployeesOccupations', listEmployeesOccupationsTest);
});
