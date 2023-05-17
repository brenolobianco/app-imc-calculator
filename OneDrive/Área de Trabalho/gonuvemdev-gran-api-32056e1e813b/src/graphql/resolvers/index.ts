import * as AuthResolvers from './AuthResolvers';
import * as AdminResolvers from './AdminResolvers';
import * as EmployeeResolvers from './EmployeeResolvers';
import * as FinishResolvers from './FinishResolvers';
import * as CdnServiceResolvers from './CdnServiceResolvers';
import * as ProductResolvers from './ProductResolvers';
import * as ClientResolvers from './ClientResolvers';
import * as OrderResolvers from './OrderResolvers';
import * as EventResolvers from './EventResolvers';
import * as StatisticsServiceResolvers from './StatisticsServiceResolvers';
import * as GeneralSearchResolvers from './GeneralSearchResolvers';

const resolvers = {
  Date: (value: string | number | Date): string =>
    new Date(value).toISOString(),
  Query: {
    wakeUp: (): string => 'GranParaná API',
    ...AuthResolvers.Query,
    ...AdminResolvers.Query,
    ...EmployeeResolvers.Query,
    ...FinishResolvers.Query,
    ...ProductResolvers.Query,
    ...ClientResolvers.Query,
    ...OrderResolvers.Query,
    ...EventResolvers.Query,
    ...StatisticsServiceResolvers.Query,
    ...GeneralSearchResolvers.Query,
  },
  Mutation: {
    ...AuthResolvers.Mutation,
    ...AdminResolvers.Mutation,
    ...EmployeeResolvers.Mutation,
    ...FinishResolvers.Mutation,
    ...CdnServiceResolvers.Mutation,
    ...ProductResolvers.Mutation,
    ...ClientResolvers.Mutation,
    ...OrderResolvers.Mutation,
    ...EventResolvers.Mutation,
  },
  ...AdminResolvers.references,
  ...ProductResolvers.references,
  ...ClientResolvers.references,
  ...OrderResolvers.references,
  ...EventResolvers.references,
};

export default resolvers;
