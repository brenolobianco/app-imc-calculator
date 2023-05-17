import * as getBusinessStatisticsSchemas from './getBusinessStatisticsSchemas';
import * as getReportDataSchemas from './getReportDataSchemas';

export const enums = `
${getReportDataSchemas.enums}
`;

export const types = `
${getBusinessStatisticsSchemas.types}
${getReportDataSchemas.types}
`;

export const Query = `
${getBusinessStatisticsSchemas.Query}
${getReportDataSchemas.Query}
`;
