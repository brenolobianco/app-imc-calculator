import { gql } from 'apollo-server-express';

import * as AuthSchemas from './AuthSchemas';
import * as AdminSchemas from './AdminSchemas';
import * as EmployeeSchemas from './EmployeeSchemas';
import * as FinishSchemas from './FinishSchemas';
import * as CdnServiceSchemas from './CdnServiceSchemas';
import * as ProductSchemas from './ProductSchemas';
import * as ClientSchemas from './ClientSchemas';
import * as OrderSchemas from './OrderSchemas';
import * as EventSchemas from './EventSchemas';
import * as StatisticsServiceSchemas from './StatisticsServiceSchemas';
import * as GeneralSearchSchemas from './GeneralSearchSchemas';

const basicTypes = `
"Tipo Date do JavaScript"
scalar Date
"Erro original. Antes de ser modificado."
type InternalError {
  name: String!
  message: String!
  stack: String
}
"Erro customizado da API"
type MyError {
  "Mensagem de erro"
  message: String
  "Tipo do erro"
  error: String
  "Código do erro 400-599"
  statusCode: Int
  "Código interno do erro 600-999"
  internalCode: Int
  "Erro interno. Apenas para ambientes dev e staging."
  internalError: InternalError
}
"Tipos de papéis"
enum Role {
  "Desenvolvedor"
  dev,
  "Administrador"
  admin
}
"Intervalo de data"
input DateIntervalInput {
  "Data inicial em ISOString"
  beginDate: Date!
  "Data final em ISOString"
  endDate: Date!
}
`;

const types = `
${AuthSchemas.types}
${AdminSchemas.types}
${EmployeeSchemas.types}
${FinishSchemas.types}
${CdnServiceSchemas.types}
${ProductSchemas.types}
${ClientSchemas.types}
${OrderSchemas.types}
${EventSchemas.types}
${StatisticsServiceSchemas.types}
${GeneralSearchSchemas.types}
`;

const enums = `
${ProductSchemas.enums}
${OrderSchemas.enums}
${StatisticsServiceSchemas.enums}
`;

const inputs = `
${AuthSchemas.inputs}
${AdminSchemas.inputs}
${EmployeeSchemas.inputs}
${FinishSchemas.inputs}
${ProductSchemas.inputs}
${ClientSchemas.inputs}
${OrderSchemas.inputs}
${EventSchemas.inputs}
${CdnServiceSchemas.inputs}
`;

const Query = `
type Query {
  "Acorda a API"
  wakeUp: String
  ${AuthSchemas.Query}
  ${AdminSchemas.Query}
  ${EmployeeSchemas.Query}
  ${FinishSchemas.Query}
  ${ProductSchemas.Query}
  ${ClientSchemas.Query}
  ${OrderSchemas.Query}
  ${EventSchemas.Query}
  ${StatisticsServiceSchemas.Query}
  ${GeneralSearchSchemas.Query}
}
`;

const Mutation = `
type Mutation {
  ${AuthSchemas.Mutation}
  ${AdminSchemas.Mutation}
  ${EmployeeSchemas.Mutation}
  ${FinishSchemas.Mutation}
  ${CdnServiceSchemas.Mutation}
  ${ProductSchemas.Mutation}
  ${ClientSchemas.Mutation}
  ${OrderSchemas.Mutation}
  ${EventSchemas.Mutation}
}
`;

const typeDefs = gql`
  ${basicTypes}
  ${types}
  ${enums}
  ${inputs}
  ${Query}
  ${Mutation}
`;

export default typeDefs;
