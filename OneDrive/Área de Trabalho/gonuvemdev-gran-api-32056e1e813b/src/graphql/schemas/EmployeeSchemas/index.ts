import * as createEmployeeSchemas from './createEmployeeSchemas';
import * as updateEmployeeSchemas from './updateEmployeeSchemas';
import * as deleteEmployeeSchemas from './deleteEmployeeSchemas';
import * as listEmployeesSchemas from './listEmployeesSchemas';
import * as readEmployeeSchemas from './readEmployeeSchemas';
import * as listEmployeesOccupationsSchemas from './listEmployeesOccupationsSchemas';

export const types = `
${createEmployeeSchemas.types}
${updateEmployeeSchemas.types}
${deleteEmployeeSchemas.types}
${listEmployeesSchemas.types}
${readEmployeeSchemas.types}
${listEmployeesOccupationsSchemas.types}
`;

export const inputs = `
${createEmployeeSchemas.inputs}
${updateEmployeeSchemas.inputs}
`;

export const Query = `
${listEmployeesSchemas.Query}
${readEmployeeSchemas.Query}
${listEmployeesOccupationsSchemas.Query}
`;

export const Mutation = `
${createEmployeeSchemas.Mutation}
${updateEmployeeSchemas.Mutation}
${deleteEmployeeSchemas.Mutation}
`;
