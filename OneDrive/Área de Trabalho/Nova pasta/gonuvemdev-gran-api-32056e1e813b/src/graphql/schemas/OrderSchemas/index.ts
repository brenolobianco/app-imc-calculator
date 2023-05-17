import * as createOrderSchemas from './createOrderSchemas';
import * as listOrdersSchemas from './listOrdersSchemas';
import * as readOrderSchemas from './readOrderSchemas';
import * as updateOrderSchemas from './updateOrderSchemas';
import * as deleteOrderSchemas from './deleteOrderSchemas';
import * as duplicateBudgetSchemas from './duplicateBudgetSchemas';

export const { enums } = createOrderSchemas;

export const types = `
${createOrderSchemas.types}
${listOrdersSchemas.types}
${readOrderSchemas.types}
${updateOrderSchemas.types}
${deleteOrderSchemas.types}
${duplicateBudgetSchemas.types}
`;

export const inputs = `
${createOrderSchemas.inputs}
${updateOrderSchemas.inputs}
`;

export const Query = `
${listOrdersSchemas.Query}
${readOrderSchemas.Query}
`;

export const Mutation = `
${createOrderSchemas.Mutation}
${updateOrderSchemas.Mutation}
${deleteOrderSchemas.Mutation}
${duplicateBudgetSchemas.Mutation}
`;
