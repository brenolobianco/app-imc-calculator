import { OrderBlueprint, OrderItem } from '../../interfaces';
import {
  OrderEventInput,
  OrderPaymentInput,
  OrderItemInput,
  CreateOrderInput,
  UpdateOrderInput,
  PaymentInstallmentInput,
  OrderBlueprintInput,
} from '../../types';
import { createArrayInput, createStringValue } from '../gqlTestHelper';

const createInputOrderEvent = (input: OrderEventInput): string => `{
  status: ${input.status},
  date: "${input.date.toISOString()}",
  description: "${input.description}",
}`;

const createInputPaymentInstallment = (
  input: PaymentInstallmentInput,
): string => `{
  number: ${input.number},
  value: ${input.value},
  expiresAt: "${input.expiresAt.toISOString()}",
  paymentMethod: "${input.paymentMethod}",
  comments: "${input.comments}",
  incomingDate: "${input.incomingDate?.toISOString()}",
}`;

const createInputOrderPayment = (input: OrderPaymentInput): string => {
  const installments = createArrayInput(
    input.installments as PaymentInstallmentInput[],
    createInputPaymentInstallment,
  );

  return `{
  paid: ${input.paid},
  conditions: "${input.conditions}",
  date: "${input.date?.toISOString()}",
  installments: ${installments},
}`;
};

const createInputOrderItem = (input: OrderItemInput): string => `{
  quantity: ${input.quantity},
  description: "${input.description}",
  product: "${input.product}",
  finish: "${input.finish}",
  depth: ${input.depth},
  length: ${input.length},
  price: ${input.price},
  discount: ${input.discount},
  addition: ${input.addition},
  discountPercentage: ${input.discountPercentage},
  additionPercentage: ${input.additionPercentage},
  m2: ${input.m2},
  unitPrice: ${input.unitPrice},
}`;

const createInputOrderBlueprint = (input: OrderBlueprintInput): string => {
  return `{
  name: "${input.name}",
  url: "${input.url}",
}`;
};

// eslint-disable-next-line max-lines-per-function
export const createInputCreateOrder = (input: CreateOrderInput): string => {
  const serviceOrder = createArrayInput(
    input.serviceOrder as string[],
    createStringValue,
  );

  return `{
  client: "${input.client}",
  sellerCommission: ${input.sellerCommission},
  intermediator: "${input.intermediator}",
  intermediatorCommission: ${input.intermediatorCommission},
  type: "${input.type}",
  date: "${input.date.toISOString()}",
  status: ${input.status},
  events: ${createArrayInput(input.events, createInputOrderEvent)},
  payment: ${createInputOrderPayment(input.payment)},
  expectedDeliveryDate: "${input.expectedDeliveryDate?.toISOString()}",
  deliveryTime: ${input.deliveryTime},
  budgetExpiryDate: "${input.budgetExpiryDate?.toISOString()}",
  assemblySchedulingDate: "${input.assemblySchedulingDate?.toISOString()}",
  furnitureAssemblyDate: "${input.furnitureAssemblyDate?.toISOString()}",
  items: ${createArrayInput(input.items, createInputOrderItem)},
  comments: "${input.comments}",
  nfe: "${input.nfe}",
  serviceOrder: ${serviceOrder},
  total: ${input.total},
  blueprint: ${createArrayInput(
    input.blueprint as OrderBlueprint[],
    createInputOrderBlueprint,
  )},
  discountTotal: ${input.discountTotal},
  additionTotal: ${input.additionTotal},
  discountTotalPercentage: ${input.discountTotalPercentage},
  additionTotalPercentage: ${input.additionTotalPercentage},
}`;
};

// eslint-disable-next-line max-lines-per-function
export const createInputUpdateOrder = (input: UpdateOrderInput): string => {
  return `{
  type: "${input.type}",
  status: ${input.status},
  payment: ${createInputOrderPayment(input.payment as OrderPaymentInput)},
  assemblySchedulingDate: "${input.assemblySchedulingDate?.toISOString()}",
  furnitureAssemblyDate: "${input.furnitureAssemblyDate?.toISOString()}",
  comments: "${input.comments}",
  nfe: "${input.nfe}",
  serviceOrder: ${createArrayInput(
    input.serviceOrder as string[],
    createStringValue,
  )},
  blueprint: ${createArrayInput(
    input.blueprint as OrderBlueprint[],
    createInputOrderBlueprint,
  )},
  items: ${createArrayInput(input.items as OrderItem[], createInputOrderItem)},
  total: ${input.total},
  expectedDeliveryDate: "${input.expectedDeliveryDate?.toISOString()}",
  budgetExpiryDate: "${input.budgetExpiryDate?.toISOString()}",
  client: "${input.client}",
  sellerCommission: ${input.sellerCommission},
  intermediator: "${input.intermediator}",
  intermediatorCommission: ${input.intermediatorCommission},
  date: "${input.date?.toISOString()}",
  deliveryTime: ${input.deliveryTime},
  discountTotal: ${input.discountTotal},
  additionTotal: ${input.additionTotal},
  discountTotalPercentage: ${input.discountTotalPercentage},
  additionTotalPercentage: ${input.additionTotalPercentage},
}`;
};
