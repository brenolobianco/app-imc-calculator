/* eslint-disable max-lines */
import { ReportDataType } from '../enums/ReportDataType';
import { ID } from './general';

/** Parâmetros da query que obtém estatísticas do negócio. */
export type GetBusinessStatisticsParams = {
  /** Data inicial. Limite inferior a ser pesquisado. */
  beginDate: Date;
  /** Data final. Limite superior a ser pesquisado. */
  endDate: Date;
  /** Data inicial. Limite inferior a ser pesquisado para geração dos dados do gráfico. */
  graphBeginDate?: Date;
  /** Data final. Limite superior a ser pesquisado para geração dos dados do gráfico. */
  graphEndDate?: Date;
};

/** Informações do produto vendido */
export type TopSellingProduct = {
  /** ID do pedido (order.items.product) */
  _id: ID;
  /** Nome (order.items.product.name) */
  name: string;
  /** Total de metros quadrados vendidos */
  totalM2: number;
  /** Total vendido em centavos (price + addition - discount) */
  total: number;
};

/** Informações do vendedor do pedido */
export type TopSeller = {
  /** ID do vendedor (order.seller) */
  _id: ID;
  /** Nome (order.seller.employee.name || order.seller.user.name) */
  name: string;
  /** Total vendido em centavos */
  total: number;
  /** Quantidade de vendas */
  count: number;
};

/** Informações das vendas por mês (Gráfico) */
export type SalesByMonth = {
  /** Ano */
  year: number;
  /** Mês. Valor entre 1 e 12. */
  month: number;
  /** Total vendido no mês em centavos */
  total: number;
  /** Quantidade de vendas no mês */
  count: number;
};

/** Resposta da query que obtém estatísticas do negócio. */
export type GetBusinessStatisticsResponse = {
  /** Quantidade de funcionários */
  numberOfAdmins: number;
  /** Quantidade de clientes */
  numberOfClients: number;
  /** Quantidade de funcionários */
  numberOfEmployees: number;
  /** Quantidade de eventos */
  numberOfEvents: number;
  /** Quantidade de acabamentos */
  numberOfFinishes: number;
  /** Quantidade de pedidos (type=order) */
  numberOfOrders: number;
  /** Quantidade de orçamentos (type=budget) */
  numberOfBudgets: number;
  /** Quantidade de produtos */
  numberOfProducts: number;
  /** Somatório do total de pedidos (type=order), em centavos, em um dado intervalo de tempo */
  orderTotalsSum: number;
  /** Quantidade de pedidos (type=order) em um dado intervalo de tempo */
  orderCount: number;
  /** Taxa de conversão de orçamento em pedido em um dado intervalo de tempo */
  budgetToOrderConversionRate: number;
  /** Quantidade de novos clientes em um dado intervalo de tempo */
  newClientsCount: number;
  /** Produtos mais vendidos em um dado intervalo de tempo */
  topSellingProducts: TopSellingProduct[];
  /** Funcionários com mais vendas em um dado intervalo de tempo */
  topSellers: TopSeller[];
  /** Total de vendas por mês (Gráfico) */
  totalSalesByMonth: SalesByMonth[];
};

/** Parâmetros da query que retorna os dados para geração dos relatórios */
export type GetReportDataParams = {
  /** Tipo dos dados do relatório */
  reportDataType: ReportDataType;
  /** Data inicial do intervalo de pesquisa das vendas. Date em ISOString. */
  beginDate?: Date;
  /** Data final do intervalo de pesquisa das vendas. Date em ISOString. */
  endDate?: Date;
  /** Filtro de vendedores pelo ID. Aplicado nos relatórios [salesInThePeriod, clientDebt, closingOfCommission] */
  sellersIds?: ID[];
  /** Filtro de produtos pelo ID. Aplicado nos relatórios [productsForProduction] */
  productsIds?: ID[];
  /** Filtro de intermediários pelo ID. Aplicado nos relatórios [salesMap]. Obs.: Não exclui o retorno das vendas sem intermediário. */
  intermediatorsIds?: ID[];
};

/** Dados do pedido de um vendedor */
export type SalesBySellerOrder = {
  /** Código do pedido */
  code: string;
  /** Nome do cliente do pedido */
  clientName: string;
  /** Data do pedido */
  date: Date;
  /** Total do pedido */
  total: number;
};

/** Vendas de um vendedor */
export type SalesBySeller = {
  /** ID do vendedor */
  sellerId: ID;
  /** Nome do vendedor */
  sellerName: string;
  /** Pedidos deste vendedor */
  orders?: SalesBySellerOrder[];
  /** Quantidade de pedidos */
  ordersCount: number;
  /** Somatório do total de pedidos em centavos */
  ordersTotalSum: number;
};

/** Dados do pedido de um produto */
export type SalesByProductOrder = {
  /** Código do pedido */
  code: string;
  /** Nome do vendedor do pedido */
  sellerName: string;
  /** Nome do cliente do pedido */
  clientName: string;
  /** Data do pedido */
  date: Date;
  /** Data de medição do pedido. (Extraído de events[].date) */
  measurementDate?: Date;
  /** Data de previsão da entrega do pedido */
  expectedDeliveryDate?: Date;
  /** Metros quadrados vendido do produto no pedido em centímetros quadrados (1 m2 = 10.000 cm2) */
  m2: number;
};

/** Vendas de um produto */
export type SalesByProduct = {
  /** ID do produto */
  productId: ID;
  /** Nome do produto */
  productName: string;
  /** Pedidos deste produto */
  orders?: SalesByProductOrder[];
  /** Quantidade de pedidos */
  ordersCount: number;
  /** Total de metros quadrados vendido deste produto em centímetros quadrados (1 m2 = 10.000 cm2) */
  totalM2: number;
};

/** Dados do pedido de um intermerdiário */
export type SalesMapByIntermediatorOrder = {
  /** Código do pedido */
  code: string;
  /** Nome do cliente do pedido */
  clientName: string;
  /** Data do pedido */
  date: Date;
  /** Total do pedido */
  total: number;
  /** Nome do vendedor do pedido */
  sellerName: string;
  /** Comissão do vendedor do pedido em centavos */
  sellerCommission: number;
  /** Comissão do vendedor do pedido em porcentagem. Valor entre 0 (0,00%) e 10000 (100,00%). */
  sellerCommissionPercentage: number;
  /** Comissão do intermediário em centavos */
  intermediatorCommission: number;
  /** Comissão do intermediário em porcentagem. Valor entre 0 (0,00%) e 10000 (100,00%). */
  intermediatorCommissionPercentage: number;
};

/** Vendas de um intermediário */
export type SalesMapByIntermediator = {
  /** ID do intermediário */
  intermediatorId?: ID;
  /** Nome do intermediário */
  intermediatorName: string;
  /** Pedidos deste intermediário */
  orders?: SalesMapByIntermediatorOrder[];
};

/** Dados do pedido com débito de clientes de um vendedor */
export type ClientDebtBySellerOrder = {
  /** Código do pedido */
  code: string;
  /** Nome do cliente do pedido */
  clientName: string;
  /** Telefone do cliente do pedido */
  clientPhone: string;
  /** Data do pedido */
  date: Date;
  /** Total do pedido */
  total: number;
  /** Valor pago do pedido */
  payment: number;
  /** Saldo do pedido */
  balance: number;
};

/** Débitos de clientes de um vendedor */
export type ClientDebtBySeller = {
  /** ID do vendedor */
  sellerId: ID;
  /** Nome do vendedor */
  sellerName: string;
  /** Pedidos deste vendedor */
  orders?: ClientDebtBySellerOrder[];
  /** Quantidade de pedidos */
  ordersCount: number;
  /** Somatório do total de pedidos em centavos */
  ordersTotalSum: number;
  /** Somatório do total pago em centavos */
  ordersPaymentSum: number;
  /** Somatório do saldo em centavos */
  ordersBalanceSum: number;
};

/** Dados do pedido com o fechamento de comissões de um vendodr */
export type ClosingOfCommissionBySellerOrder = {
  /** Código do pedido */
  code: string;
  /** Nome do cliente do pedido */
  clientName: string;
  /** Data do pedido */
  date: Date;
  /** Total do pedido */
  total: number;
  /** Comissão do vendedor em centavos */
  sellerCommission: number;
  /** Percentual da comissão do vendedor. Valor entre 0 (0,00%) e 10000 (100,00%). */
  sellerCommissionPercentage: number;
};

/** Fechamento de comissões de um vendedor */
export type ClosingOfCommissionBySeller = {
  /** ID do vendedr */
  sellerId: ID;
  /** Nome do vendedor */
  sellerName: string;
  /** Pedidos do vendedor */
  orders?: ClosingOfCommissionBySellerOrder[];
  /** Quantidade de pedidos */
  ordersCount: number;
  /** Somatório do total de pedidos em centavos */
  ordersTotalSum: number;
  /** Somatório das comissões dos pedidos em centavos */
  ordersCommissionSum: number;
};

/** Resposta da query que retorna os dados para geração dos relatórios */
export type GetReportDataResponse = {
  /** Vendas no Período - Todos os Vendedores */
  salesInThePeriodReportData?: SalesBySeller[];
  /** Produtos Para Produção - Por Produto - GERAL */
  productsForProductionReportData?: SalesByProduct[];
  /** Mapa de Vendas - Intermediário */
  salesMapReportData?: SalesMapByIntermediator[];
  /** Débito de Clientes - Por Vendedor */
  clientDebtBySellerReportData?: ClientDebtBySeller[];
  /** Fechamento de Comissões */
  closingOfCommissionsReportData?: ClosingOfCommissionBySeller[];
};
