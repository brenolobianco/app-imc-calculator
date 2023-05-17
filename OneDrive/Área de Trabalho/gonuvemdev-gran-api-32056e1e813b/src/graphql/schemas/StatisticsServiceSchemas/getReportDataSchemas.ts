/* eslint-disable max-lines */
const ReportDataTypeEnum = `
"Tipo dos dados do relatório"
enum ReportDataType {
  "Mapa de vendas"
  salesMap
  "Fechamento de comissões"
  closingOfCommission
  "Débito de clientes"
  clientDebt
  "Produtos para produção"
  productsForProduction
  "Vendas no período"
  salesInThePeriod
}
`;

const SalesBySellerOrderType = `
"Dados do pedido de um vendedor"
type SalesBySellerOrder {
  "Código do pedido"
  code: String!
  "Nome do cliente do pedido"
  clientName: String!
  "Data do pedido"
  date: Date!
  "Total do pedido"
  total: Int!
}
`;

const SalesBySellerType = `
"Vendas de um vendedor"
type SalesBySeller {
  "ID do vendedor"
  sellerId: ID!
  "Nome do vendedor"
  sellerName: String!
  "Pedidos deste vendedor"
  orders: [SalesBySellerOrder!]
  "Quantidade de pedidos"
  ordersCount: Int!
  "Somatório do total de pedidos em centavos"
  ordersTotalSum: Int!
}
`;

const SalesByProductOrderType = `
"Dados do pedido de um produto"
type SalesByProductOrder {
  "Código do pedido"
  code: String!
  "Nome do vendedor do pedido"
  sellerName: String!
  "Nome do cliente do pedido"
  clientName: String!
  "Data do pedido"
  date: Date!
  "Data de medição do pedido. (Extraído de events[].date)"
  measurementDate: Date
  "Data de previsão da entrega do pedido"
  expectedDeliveryDate: Date
  "Metros quadrados vendido do produto no pedido em centímetros quadrados (1 m2 = 10.000 cm2)"
  m2: Int!
}
`;

const SalesByProductType = `
"Vendas de um produto"
type SalesByProduct {
  "ID do produto"
  productId: ID!
  "Nome do produto"
  productName: String!
  "Pedidos deste produto"
  orders: [SalesByProductOrder!]
  "Quantidade de pedidos"
  ordersCount: Int!
  "Total de metros quadrados vendido deste produto em centímetros quadrados (1 m2 = 10.000 cm2)"
  totalM2: Int!
}
`;

const SalesMapByIntermediatorOrderType = `
"Dados do pedido de um intermerdiário"
type SalesMapByIntermediatorOrder {
  "Código do pedido"
  code: String!
  "Nome do cliente do pedido"
  clientName: String!
  "Data do pedido"
  date: Date!
  "Total do pedido"
  total: Int!
  "Nome do vendedor do pedido"
  sellerName: String!
  "Comissão do vendedor do pedido em centavos"
  sellerCommission: Int!
  "Comissão do vendedor do pedido em porcentagem. Valor entre 0 (0,00%) e 10000 (100,00%)."
  sellerCommissionPercentage: Int!
  "Comissão do intermediário em centavos"
  intermediatorCommission: Int!
  "Comissão do intermediário em porcentagem. Valor entre 0 (0,00%) e 10000 (100,00%)."
  intermediatorCommissionPercentage: Int!
}
`;

const SalesMapByIntermediatorType = `
"Vendas de um intermediário"
type SalesMapByIntermediator {
  "ID do intermediário"
  intermediatorId: ID
  "Nome do intermediário"
  intermediatorName: String
  "Pedidos deste intermediário"
  orders: [SalesMapByIntermediatorOrder!]
}
`;

const ClientDebtBySellerOrderType = `
"Dados do pedido com débito de clientes de um vendedor"
type ClientDebtBySellerOrder {
  "Código do pedido"
  code: String!
  "Nome do cliente do pedido"
  clientName: String!
  "Telefone do cliente do pedido"
  clientPhone: String!
  "Data do pedido"
  date: Date!
  "Total do pedido"
  total: Int!
  "Valor pago do pedido"
  payment: Int!
  "Saldo do pedido"
  balance: Int!
}
`;

const ClientDebtBySellerType = `
"Débitos de clientes de um vendedor"
type ClientDebtBySeller {
  "ID do vendedor"
  sellerId: ID!
  "Nome do vendedor"
  sellerName: String!
  "Pedidos deste vendedor"
  orders: [ClientDebtBySellerOrder!]
  "Quantidade de pedidos"
  ordersCount: Int!
  "Somatório do total de pedidos em centavos"
  ordersTotalSum: Int!
  "Somatório do total pago em centavos"
  ordersPaymentSum: Int!
  "Somatório do saldo em centavos"
  ordersBalanceSum: Int!
}
`;

const ClosingOfCommissionBySellerOrderType = `
"Dados do pedido com o fechamento de comissões de um vendodr"
type ClosingOfCommissionBySellerOrder {
  "Código do pedido"
  code: String!
  "Nome do cliente do pedido"
  clientName: String!
  "Data do pedido"
  date: Date!
  "Total do pedido"
  total: Int!
  "Comissão do vendedor em centavos"
  sellerCommission: Int!
  "Percentual da comissão do vendedor. Valor entre 0 (0,00%) e 10000 (100,00%)."
  sellerCommissionPercentage: Int!
}
`;

const ClosingOfCommissionBySellerType = `
"Fechamento de comissões de um vendedor"
type ClosingOfCommissionBySeller {
  "ID do vendedr"
  sellerId: ID!
  "Nome do vendedor"
  sellerName: String!
  "Pedidos do vendedor"
  orders: [ClosingOfCommissionBySellerOrder!]
  "Quantidade de pedidos"
  ordersCount: Int!
  "Somatório do total de pedidos em centavos"
  ordersTotalSum: Int!
  "Somatório das comissões dos pedidos em centavos"
  ordersCommissionSum: Int!
}
`;

const GetReportDataResponseType = `
"Resposta da query que retorna os dados para geração dos relatórios"
type GetReportDataResponse {
  "Vendas no Período - Todos os Vendedores"
  salesInThePeriodReportData: [SalesBySeller!]
  "Produtos Para Produção - Por Produto - GERAL"
  productsForProductionReportData: [SalesByProduct!]
  "Mapa de Vendas - Intermediário"
  salesMapReportData: [SalesMapByIntermediator!]
  "Débito de Clientes - Por Vendedor"
  clientDebtBySellerReportData: [ClientDebtBySeller!]
  "Fechamento de Comissões"
  closingOfCommissionsReportData: [ClosingOfCommissionBySeller!]
  """
  | internalCode | statusCode | message/Descrição                                           |
  | :----------- | :--------: | ----------------------------------------------------------- |
  | 600          |    500     | Erro inesperado. Veja error.internalError e avisar ao back. |
  | 610          |    403     | Token inválido                                              |
  | 611          |    401     | Cabeçalho de autorização inválido                           |
  | 700          |    404     | Usuário não encontrado                                      |
  | 620          |    403     | Este usuário não possui permissão para esta ação            |
  | 630          |    400     | Erro na validação. Veja error.message                       |
  """
  error: MyError
}
`;

const getReportDataQuery = `
"Obtém dados para geraçãos do relatórios. APENAS PARA ('dev', 'admin')"
getReportData(
  "Tipo dos dados do relatório"
  reportDataType: ReportDataType!
  "Data inicial do intervalo de pesquisa das vendas. Date em ISOString."
  beginDate: Date
  "Data final do intervalo de pesquisa das vendas. Date em ISOString."
  endDate: Date
  "Filtro de vendedores pelo ID. Aplicado nos relatórios [salesInThePeriod, clientDebt, closingOfCommission]"
  sellersIds: [ID!]
  "Filtro de produtos pelo ID. Aplicado nos relatórios [productsForProduction]"
  productsIds: [ID!]
  "Filtro de intermediários pelo ID. Aplicado nos relatórios [salesMap]. Obs.: Não exclui o retorno das vendas sem intermediário."
  intermediatorsIds: [ID!]
): GetReportDataResponse
`;

export const enums = `${ReportDataTypeEnum}`;

export const types = `
${SalesBySellerOrderType}
${SalesBySellerType}
${SalesByProductOrderType}
${SalesByProductType}
${SalesMapByIntermediatorOrderType}
${SalesMapByIntermediatorType}
${ClientDebtBySellerOrderType}
${ClientDebtBySellerType}
${ClosingOfCommissionBySellerOrderType}
${ClosingOfCommissionBySellerType}
${GetReportDataResponseType}
`;

export const Query = `${getReportDataQuery}`;
