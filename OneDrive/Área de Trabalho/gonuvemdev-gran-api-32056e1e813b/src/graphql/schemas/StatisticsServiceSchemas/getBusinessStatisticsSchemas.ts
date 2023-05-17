const TopSellingProductType = `
"Informações do produto vendido"
type TopSellingProduct {
  "ID do pedido (order.items.product)"
  _id: ID!
  "Nome (order.items.product.name)"
  name: String!
  "Total de metros quadrados vendidos"
  totalM2: Int!
  "Total vendido em centavos (price + addition - discount)"
  total: Int!
}`;

const TopSellerType = `
"Informações do vendedor do pedido"
type TopSeller {
  "ID do vendedor (order.seller)"
  _id: ID!
  "Nome (order.seller.user.name)"
  name: String!
  "Total vendido em centavos"
  total: Int!
  "Quantidade de vendas"
  count: Int!
}`;

const SalesByMonthType = `
"Informações das vendas por mês (Gráfico)"
type SalesByMonth {
  "Ano"
  year: Int!
  "Mês. Valor entre 1 e 12."
  month: Int!
  "Total vendido no mês em centavos"
  total: Int!
  "Quantidade de vendas no mês"
  count: Int!
}`;

const GetBusinessStatisticsType = `
"Resposta da query que obtém estatísticas do negócio."
type GetBusinessStatistics {
  "Quantidade de funcionários"
  numberOfAdmins: Int
  "Quantidade de clientes"
  numberOfClients: Int
  "Quantidade de funcionários"
  numberOfEmployees: Int
  "Quantidade de eventos"
  numberOfEvents: Int
  "Quantidade de acabamentos"
  numberOfFinishes: Int
  "Quantidade de pedidos (type=order)"
  numberOfOrders: Int
  "Quantidade de orçamentos (type=budget)"
  numberOfBudgets: Int
  "Quantidade de produtos"
  numberOfProducts: Int
  "Somatório do total de pedidos (type=order), em centavos, em um dado intervalo de tempo"
  orderTotalsSum: Int
  "Quantidade de pedidos (type=order) em um dado intervalo de tempo"
  orderCount: Int
  "Taxa de conversão de orçamento em pedido em um dado intervalo de tempo"
  budgetToOrderConversionRate: Float
  "Quantidade de novos clientes em um dado intervalo de tempo"
  newClientsCount: Int
  "Produtos mais vendidos em um dado intervalo de tempo ordenados decrescentemente por 'totalM2'"
  topSellingProducts: [TopSellingProduct!]
  "Funcionários com mais vendas em um dado intervalo de tempo ordernados decrescentemente por 'total'"
  topSellers: [TopSeller!]
  "Total de vendas por mês (Gráfico) ordenados crescentemente pelo par 'year, month'"
  totalSalesByMonth: [SalesByMonth!]
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

const getBusinessStatisticsQuery = `
"Obtém estatísticas do negócio. APENAS PARA ('dev', 'admin')"
getBusinessStatistics(
  "Data inicial. Limite inferior a ser pesquisado."
  beginDate: Date!
  "Data final. Limite superior a ser pesquisado."
  endDate: Date!
  "Data inicial. Limite inferior a ser pesquisado para geração dos dados do gráfico."
  graphBeginDate: Date
  "Data final. Limite superior a ser pesquisado para geração dos dados do gráfico. É obrigatório quando 'graphBeginDate' for enviado."
  graphEndDate: Date
): GetBusinessStatistics
`;

export const types = `
${TopSellingProductType}
${TopSellerType}
${SalesByMonthType}
${GetBusinessStatisticsType}
`;

export const Query = getBusinessStatisticsQuery;
