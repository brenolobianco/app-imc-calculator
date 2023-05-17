import * as createAdminSchemas from './createAdminSchemas';
import * as updateAdminSchemas from './updateAdminSchemas';
import * as deleteAdminSchemas from './deleteAdminSchemas';
import * as listAdminsSchemas from './listAdminsSchemas';
import * as readAdminSchemas from './readAdminSchemas';

export const types = `
${createAdminSchemas.types}
${updateAdminSchemas.types}
${deleteAdminSchemas.types}
${listAdminsSchemas.types}
${readAdminSchemas.types}
`;

export const inputs = `
${createAdminSchemas.inputs}
${updateAdminSchemas.inputs}
`;

export const Query = `
${listAdminsSchemas.Query}
${readAdminSchemas.Query}
`;

export const Mutation = `
${createAdminSchemas.Mutation}
${updateAdminSchemas.Mutation}
${deleteAdminSchemas.Mutation}
`;
