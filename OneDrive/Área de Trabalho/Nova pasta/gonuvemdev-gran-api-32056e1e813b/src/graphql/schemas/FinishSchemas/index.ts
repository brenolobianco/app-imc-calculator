import * as createFinishSchemas from './createFinishSchemas';
import * as updateFinishSchemas from './updateFinishSchemas';
import * as deleteFinishSchemas from './deleteFinishSchemas';
import * as listFinishesSchemas from './listFinishesSchemas';
import * as readFinishSchemas from './readFinishSchemas';

export const types = `
${createFinishSchemas.types}
${updateFinishSchemas.types}
${deleteFinishSchemas.types}
${listFinishesSchemas.types}
${readFinishSchemas.types}
`;

export const inputs = `
${createFinishSchemas.inputs}
${updateFinishSchemas.inputs}
`;

export const Query = `
${listFinishesSchemas.Query}
${readFinishSchemas.Query}
`;

export const Mutation = `
${createFinishSchemas.Mutation}
${updateFinishSchemas.Mutation}
${deleteFinishSchemas.Mutation}
`;
