import * as AuthSchemas from './AuthResolverJoiSchemas';
import * as AdminSchemas from './AdminJoiSchemas';
import * as EmployeeSchemas from './EmployeeJoiSchemas';
import * as FinishJoiSchemas from './FinishJoiSchemas';
import * as ProductJoiSchemas from './ProductJoiSchemas';
import * as ClientJoiSchemas from './ClientJoiSchemas';
import * as OrderJoiSchemas from './OrderJoiSchemas';
import * as EventJoiSchemas from './EventJoiSchemas';
import * as BudgetJoiSchemas from './BudgetJoiSchemas';
import * as StatisticsServiceJoiSchemas from './StatisticsServiceJoiSchemas';
import * as AgreementJoiSchemas from './AgreementJoiSchemas';
import * as GeneralSearchSchemas from './GeneralSearchSchemas';

export default {
  ...AuthSchemas.resolvers,
  ...AdminSchemas.resolvers,
  ...EmployeeSchemas.resolvers,
  ...FinishJoiSchemas.resolvers,
  ...ProductJoiSchemas.resolvers,
  ...ClientJoiSchemas.resolvers,
  ...OrderJoiSchemas.resolvers,
  ...EventJoiSchemas.resolvers,
  ...BudgetJoiSchemas.routes,
  ...StatisticsServiceJoiSchemas.resolvers,
  ...AgreementJoiSchemas.routes,
  ...GeneralSearchSchemas.resolvers,
};
