import * as createProductSchemas from './createProductSchemas';
import * as updateProductSchemas from './updateProductSchemas';
import * as deleteProductSchemas from './deleteProductSchemas';
import * as listProductsSchemas from './listProductsSchemas';
import * as readProductSchemas from './readProductSchemas';
import * as updateProductPricesSchemas from './updateProductPricesSchemas';

export const { enums } = createProductSchemas;

export const types = `
${createProductSchemas.types}
${updateProductSchemas.types}
${deleteProductSchemas.types}
${listProductsSchemas.types}
${readProductSchemas.types}
${updateProductPricesSchemas.types}
`;

export const inputs = `
${createProductSchemas.inputs}
${updateProductSchemas.inputs}
${updateProductPricesSchemas.inputs}
`;

export const Query = `
${listProductsSchemas.Query}
${readProductSchemas.Query}
`;

export const Mutation = `
${createProductSchemas.Mutation}
${updateProductSchemas.Mutation}
${deleteProductSchemas.Mutation}
${updateProductPricesSchemas.Mutation}
`;
