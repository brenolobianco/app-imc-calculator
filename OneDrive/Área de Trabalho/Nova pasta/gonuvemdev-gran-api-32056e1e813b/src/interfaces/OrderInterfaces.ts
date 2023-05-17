import { Document } from 'mongoose';

import { OrderStatus } from '../enums';
import { ID } from '../types';
import { AdminDoc } from './AdminInterfaces';
import { ClientDoc } from './ClientInterfaces';
import { EmployeeDoc } from './EmployeeInterfaces';
import { FinishDoc } from './FinishInterfaces';
import { Timestamps } from './general';
import { ProductDoc } from './ProductInterfaces';

/** Evento do Pedido */
export interface OrderEvent {
  /** Status do evento */
  status: OrderStatus;
  /** Data do evento */
  date: Date;
  /** Descrição do evento */
  description?: string;
}

/** Parcela de um Pagamento */
export interface PaymentInstallment {
  /** Número da parcela */
  number: number;
  /** Valor da parcela em centavos */
  value: number;
  /** Data de vencimento da parcela */
  expiresAt: Date;
  /** Meio de pagamento */
  paymentMethod?: string;
  /** Observações ou informações adicionais */
  comments?: string;
  /** Data de entrada no Caixa */
  incomingDate?: Date;
}

/** Informações do Pagamento do Pedido */
export interface OrderPayment {
  /** Status do pagamento */
  paid: boolean;
  /** Condições de pagamento */
  conditions?: string;
  /** Data do pagamento */
  date?: Date;
  /** Parcelas do pagamento */
  installments?: PaymentInstallment[];
}

/** Item do Pedido */
export interface OrderItem {
  /** Quantidade */
  quantity: number;
  /** Descrição */
  description: string;
  /** Produto */
  product: ProductDoc | ID;
  /** Acabamento */
  finish: FinishDoc | ID;
  /** Profundidade em centimetros */
  depth: number;
  /** Comprimento em centimetros */
  length: number;
  /** Preço em centavos */
  price: number;
  /** Desconto em centavos */
  discount?: number;
  /** Acréscimo em centavos */
  addition?: number;
  /** Percentual do desconto. Valor entre 0 (0,00%) e 10000 (100,00%). */
  discountPercentage?: number;
  /** Percentual do acréscimo. Valor entre 0 (0,00%) e 10000 (100,00%). */
  additionPercentage?: number;
  /** Total de metro quadrado do item em centímetros quadrados (1 m2 = 10.000 cm2) */
  m2: number;
  /** Preço unitário em centavos */
  unitPrice: number;
}

/** Planta baixa do Pedido */
export interface OrderBlueprint {
  /** Nome do arquivo da planta baixa */
  name: string;
  /** URL de onde está hospedado o arquivo da planta baixa */
  url: string;
}

/** Pedido */
export interface OrderInterface {
  /** Código sequencial gerado pelo sistema */
  code: string;
  /** Cliente */
  client: ClientDoc | ID;
  /** Vendedor. Administrador logado que criou o Pedido */
  seller: AdminDoc | ID;
  /** Comissão do vendedor */
  sellerCommission: number;
  /** Funcionário intermediário */
  intermediator?: EmployeeDoc | ID;
  /** Comissão do intermediário */
  intermediatorCommission?: number;
  /** Tipo. Informa se é Pedido ou Orçamento. Valores válidos ['budget', 'order'] */
  type: 'budget' | 'order';
  /** Data */
  date: Date;
  /** Status */
  status: OrderStatus;
  /** Histórico de eventos */
  events: OrderEvent[];
  /** Informações do Pagamento */
  payment?: OrderPayment;
  /** Data de previsão da entrega */
  expectedDeliveryDate?: Date;
  /** Dias úteis até a entrega */
  deliveryTime?: number;
  /** Data de validade do orçamento */
  budgetExpiryDate?: Date;
  /** Data do agendamento da montagem */
  assemblySchedulingDate?: Date;
  /** Data da montagem do móvel */
  furnitureAssemblyDate?: Date;
  /** Itens */
  items: OrderItem[];
  /** Observações */
  comments?: string;
  /** Url da imagem da Nota Fiscal Eletrônica */
  nfe?: string;
  /** Urls das imagens da Ordem de Serviço */
  serviceOrder?: string[];
  /** Total do Pedido em centavos */
  total: number;
  /** Lista dos arquivos da planta baixa */
  blueprint?: OrderBlueprint[];
  /** Desconto total em centavos */
  discountTotal?: number;
  /** Acréscimo total em centavos */
  additionTotal?: number;
  /** Percentual do desconto total. Valor entre 0 (0,00%) e 10000 (100,00%). */
  discountTotalPercentage?: number;
  /** Percentual do acréscimo total. Valor entre 0 (0,00%) e 10000 (100,00%). */
  additionTotalPercentage?: number;
}

// eslint-disable-next-line prettier/prettier
export interface OrderDocument extends OrderInterface, Document, Timestamps { }

export interface OrderDoc extends OrderInterface, Timestamps {
  _id: ID;
}
