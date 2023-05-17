import DataLoader from 'dataloader';

import { ID, ListParams, ListResponse } from './general';
import {
  OrderInterface,
  OrderDocument,
  OrderPayment,
  OrderItem,
  OrderEvent,
  PaymentInstallment,
  OrderBlueprint,
} from '../interfaces';

/** Evento do Pedido */
export type OrderEventInput = {
  /** Status do evento */
  status: OrderEvent['status'];
  /** Data do evento. Date em ISOString. */
  date: OrderEvent['date'];
  /** Descrição do evento. Mínimo: 1 caracter */
  description: OrderEvent['description'];
};

/** Parâmetros de uma parcela de um Pagamento */
export type PaymentInstallmentInput = {
  /** Número da parcela. Mínimo: 1 */
  number: PaymentInstallment['number'];
  /** Valor da parcela em centavos. Mínimo: 0 */
  value: PaymentInstallment['value'];
  /** Data de vencimento da parcela. Date em ISOString */
  expiresAt: PaymentInstallment['expiresAt'];
  /** Meio de pagamento. Mínimo: 1 caracter */
  paymentMethod: PaymentInstallment['paymentMethod'];
  /** Observações ou informações adicionais. Mínimo: 1 caracter */
  comments: PaymentInstallment['comments'];
  /** Data de entrada no Caixa. Date em ISOString */
  incomingDate: PaymentInstallment['incomingDate'];
};

/** Informações do Pagamento do Pedido */
export type OrderPaymentInput = {
  /** Status do pagamento */
  paid: OrderPayment['paid'];
  /** Condições de pagamento. Mínimo: 1 caracter */
  conditions: OrderPayment['conditions'];
  /** Data do pagamento. Date em ISOString */
  date: OrderPayment['date'];
  /** Parcelas do pagamento */
  installments?: PaymentInstallmentInput[];
};

/** Item do Pedido */
export type OrderItemInput = {
  /** Quantidade. Mínimo: 1 */
  quantity: OrderItem['quantity'];
  /** Descrição. Mínimo: 1 caracter */
  description: OrderItem['description'];
  /** Produto. Regex: /^[0-9a-fA-F]{24}$/ */
  product: ID;
  /** Acabamento. Regex: /^[0-9a-fA-F]{24}$/ */
  finish: ID;
  /** Profundidade em centimetros. Mínimo: 0 */
  depth: OrderItem['depth'];
  /** Comprimento em centimetros. Mínimo: 0 */
  length: OrderItem['length'];
  /** Preço em centavos. Mínimo: 0 */
  price: OrderItem['price'];
  /** Desconto em centavos. Mínimo: 0 */
  discount: OrderItem['discount'];
  /** Acréscimo em centavos. Mínimo: 0 */
  addition: OrderItem['addition'];
  /** Percentual do desconto. Valor entre 0 (0,00%) e 10000 (100,00%). */
  discountPercentage: OrderItem['discountPercentage'];
  /** Percentual do acréscimo. Valor entre 0 (0,00%) e 10000 (100,00%). */
  additionPercentage: OrderItem['additionPercentage'];
  /** Total de metro quadrado do item em centímetros quadrados (1 m2 = 10.000 cm2). Mínimo: 0 */
  m2: OrderItem['m2'];
  /** Preço unitário em centavos. Mínimo: 0 */
  unitPrice: OrderItem['unitPrice'];
};

/** Planta baixa do Pedido */
export type OrderBlueprintInput = {
  /** Nome do arquivo da planta baixa. Mínimo: 1 caracter */
  name: OrderBlueprint['name'];
  /** URL de onde está hospedado o arquivo da planta baixa. Formato de url válido. */
  url: OrderBlueprint['url'];
};

/** Parâmetros para cadastro de Pedido */
export type CreateOrderInput = {
  /** Cliente. Regex: /^[0-9a-fA-F]{24}$/ */
  client: OrderInterface['client'];
  /** Comissão do vendedor. Valor entre 0 (0,00%) e 10000 (100,00%). */
  sellerCommission: OrderInterface['sellerCommission'];
  /** Funcionário intermediário. Regex: /^[0-9a-fA-F]{24}$/ */
  intermediator: OrderInterface['intermediator'];
  /** Comissão do intermediário. Valor entre 0 (0,00%) e 10000 (100,00%). */
  intermediatorCommission: OrderInterface['intermediatorCommission'];
  /** Tipo. Informa se é Pedido ou Orçamento. Valores válidos ['budget', 'order']. Default: 'budget' */
  type: OrderInterface['type'];
  /** Data. Date em ISOString */
  date: OrderInterface['date'];
  /** Status */
  status: OrderInterface['status'];
  /** Histórico de eventos */
  events: OrderEventInput[];
  /** Informações do Pagamento */
  payment: OrderPaymentInput;
  /** Data de previsão da entrega. Date em ISOString */
  expectedDeliveryDate: OrderInterface['expectedDeliveryDate'];
  /** Dias úteis até a entrega. Mínimo: 0 */
  deliveryTime: OrderInterface['deliveryTime'];
  /** Data de validade do orçamento. Date em ISOString */
  budgetExpiryDate: OrderInterface['budgetExpiryDate'];
  /** Data do agendamento da montagem. Date em ISOString */
  assemblySchedulingDate: OrderInterface['assemblySchedulingDate'];
  /** Data da montagem do móvel. Date em ISOString */
  furnitureAssemblyDate: OrderInterface['furnitureAssemblyDate'];
  /** Itens */
  items: OrderItemInput[];
  /** Observações. Mínimo: 1 caracter */
  comments: OrderInterface['comments'];
  /** Url da imagem da Nota Fiscal Eletrônica. Formato de url válido. */
  nfe: OrderInterface['nfe'];
  /** Urls das imagens da Ordem de Serviço. Formato de url válido. */
  serviceOrder: OrderInterface['serviceOrder'];
  /** Total do Pedido em centavos. Mínimo: 0 */
  total: OrderInterface['total'];
  /** Lista dos arquivos da planta baixa. */
  blueprint?: OrderBlueprintInput[];
  /** Desconto total em centavos. Mínimo: 0 */
  discountTotal: OrderInterface['discountTotal'];
  /** Acréscimo total em centavos. Mínimo: 0 */
  additionTotal: OrderInterface['additionTotal'];
  /** Percentual do desconto total. Valor entre 0 (0,00%) e 10000 (100,00%). */
  discountTotalPercentage: OrderInterface['discountTotalPercentage'];
  /** Percentual do acréscimo total. Valor entre 0 (0,00%) e 10000 (100,00%). */
  additionTotalPercentage: OrderInterface['additionTotalPercentage'];
};

/** Filtros de Pedido */
export type OrderFilter = {
  /** Filtro de Cliente */
  client?: ID;
  /** Filtro de Funcionário vendedor. ID de Admin. */
  seller?: ID;
  /** Filtro de Funcionário intermediário. ID de Employee. */
  intermediator?: ID;
  /** Filtro de tipo */
  type?: OrderInterface['type'];
  /** Filtro de status */
  status?: OrderInterface['status'];
  /** Filtro de status do pagamento */
  paymentPaid?: OrderPayment['paid'];
};

export type ListOrdersParams = ListParams<OrderFilter>;

export type ListOrdersResponse = ListResponse & {
  orders: OrderDocument[];
};

export type OrderItemsDataLoader = DataLoader<
  OrderDocument,
  OrderItem[],
  OrderDocument[]
>;

/** Parâmetros para atualização de Pedido */
export type UpdateOrderInput = {
  /** Tipo. Informa se é Pedido ou Orçamento. Valores válidos ['budget', 'order']. Default: 'budget' */
  type?: OrderInterface['type'];
  /** Status */
  status?: OrderInterface['status'];
  /** Informações do Pagamento */
  payment?: OrderPaymentInput;
  /** Data do agendamento da montagem. Date em ISOString */
  assemblySchedulingDate?: OrderInterface['assemblySchedulingDate'];
  /** Data da montagem do móvel. Date em ISOString */
  furnitureAssemblyDate?: OrderInterface['furnitureAssemblyDate'];
  /** Observações. Mínimo: 1 caracter */
  comments?: OrderInterface['comments'];
  /** Url da imagem da Nota Fiscal Eletrônica. Formato de url válido. */
  nfe?: string;
  /** Urls das imagens da Ordem de Serviço. Formato de url válido. */
  serviceOrder?: string[];
  /** Lista dos arquivos da planta baixa. */
  blueprint?: OrderBlueprintInput[];
  /** Itens */
  items?: OrderItemInput[];
  /** Total do Pedido em centavos. Mínimo: 0 */
  total?: OrderInterface['total'];
  /** Data de previsão da entrega. Date em ISOString */
  expectedDeliveryDate?: OrderInterface['expectedDeliveryDate'];
  /** Data de validade do orçamento. Date em ISOString */
  budgetExpiryDate?: OrderInterface['budgetExpiryDate'];
  /** Cliente. Regex: /^[0-9a-fA-F]{24}$/ */
  client?: OrderInterface['client'];
  /** Comissão do vendedor. Valor entre 0 (0,00%) e 10000 (100,00%). */
  sellerCommission?: OrderInterface['sellerCommission'];
  /** Funcionário intermediário. Regex: /^[0-9a-fA-F]{24}$/ */
  intermediator?: OrderInterface['intermediator'];
  /** Comissão do intermediário. Valor entre 0 (0,00%) e 10000 (100,00%). */
  intermediatorCommission?: OrderInterface['intermediatorCommission'];
  /** Data. Date em ISOString */
  date?: OrderInterface['date'];
  /** Dias úteis até a entrega. Mínimo: 0 */
  deliveryTime?: OrderInterface['deliveryTime'];
  /** Desconto total em centavos. Mínimo: 0 */
  discountTotal: OrderInterface['discountTotal'];
  /** Acréscimo total em centavos. Mínimo: 0 */
  additionTotal: OrderInterface['additionTotal'];
  /** Percentual do desconto total. Valor entre 0 (0,00%) e 10000 (100,00%). */
  discountTotalPercentage: OrderInterface['discountTotalPercentage'];
  /** Percentual do acréscimo total. Valor entre 0 (0,00%) e 10000 (100,00%). */
  additionTotalPercentage: OrderInterface['additionTotalPercentage'];
};
