import Joi from 'joi';
import { OrderStatus } from '../../../enums';

import {
  OrderBlueprint,
  OrderEvent,
  OrderInterface,
  OrderItem,
  OrderPayment,
  PaymentInstallment,
} from '../../../interfaces';
import {
  JoiSchemaMap,
  CreateOrderInput,
  OrderFilter,
  UpdateOrderInput,
} from '../../../types';
import {
  arraySchema,
  basicStringSchema,
  booleanSchema,
  createSchema,
  dateSchema,
  digitsStringSchema,
  idSchema,
  integerSchema,
  listSchema,
  readSchema,
  removeSchema,
  stringEnumSchema,
  updateSchema,
  urlSchema,
} from './baseSchemas';

const orderEventKeys: JoiSchemaMap<Required<OrderEvent>> = {
  status: stringEnumSchema(OrderStatus),
  date: dateSchema,
  description: basicStringSchema,
};

const paymentInstallmentKeys: JoiSchemaMap<PaymentInstallment> = {
  number: integerSchema.min(1),
  value: integerSchema.min(0),
  expiresAt: dateSchema,
  paymentMethod: basicStringSchema,
  comments: basicStringSchema,
  incomingDate: dateSchema,
};

const orderPaymentKeys: JoiSchemaMap<Required<OrderPayment>> = {
  paid: booleanSchema,
  conditions: basicStringSchema,
  date: dateSchema,
  installments: arraySchema(Joi.object(paymentInstallmentKeys).required()),
};

const orderItemKeys: JoiSchemaMap<Required<OrderItem>> = {
  quantity: integerSchema.min(1),
  description: basicStringSchema,
  product: idSchema,
  finish: idSchema,
  depth: integerSchema.min(0),
  length: integerSchema.min(0),
  price: integerSchema.min(0),
  discount: integerSchema.min(0),
  addition: integerSchema.min(0),
  discountPercentage: integerSchema.min(0).max(9999),
  additionPercentage: integerSchema.min(0).max(9999),
  m2: integerSchema.min(0),
  unitPrice: integerSchema.min(0),
};

const orderBlueprintKeys: JoiSchemaMap<OrderBlueprint> = {
  name: basicStringSchema,
  url: urlSchema,
};

export const OrderSchema: JoiSchemaMap<OrderInterface> = {
  code: digitsStringSchema,
  client: idSchema,
  seller: idSchema,
  sellerCommission: integerSchema.min(0).max(9999),
  intermediator: idSchema,
  intermediatorCommission: integerSchema.min(0).max(9999),
  type: basicStringSchema.valid('budget', 'order'),
  date: dateSchema,
  status: stringEnumSchema(OrderStatus),
  events: arraySchema(Joi.object(orderEventKeys)),
  payment: Joi.object(orderPaymentKeys),
  expectedDeliveryDate: dateSchema,
  deliveryTime: integerSchema.min(0),
  budgetExpiryDate: dateSchema,
  assemblySchedulingDate: dateSchema,
  furnitureAssemblyDate: dateSchema,
  items: arraySchema(Joi.object(orderItemKeys).required()).min(1),
  comments: basicStringSchema,
  nfe: urlSchema,
  serviceOrder: arraySchema(urlSchema.required()),
  total: integerSchema.min(0),
  blueprint: arraySchema(Joi.object(orderBlueprintKeys)),
  discountTotal: integerSchema.min(0),
  additionTotal: integerSchema.min(0),
  discountTotalPercentage: integerSchema.min(0).max(9999),
  additionTotalPercentage: integerSchema.min(0).max(9999),
};

const createKeys: JoiSchemaMap<CreateOrderInput> = {
  client: OrderSchema.client.required(),
  sellerCommission: OrderSchema.sellerCommission.required(),
  intermediator: OrderSchema.intermediator.optional(),
  intermediatorCommission: OrderSchema.intermediatorCommission.optional(),
  type: OrderSchema.type.required(),
  date: OrderSchema.date.required(),
  status: OrderSchema.status.required(),
  events: OrderSchema.events.optional(),
  payment: OrderSchema.payment.optional(),
  expectedDeliveryDate: OrderSchema.expectedDeliveryDate.optional(),
  deliveryTime: OrderSchema.deliveryTime.optional(),
  budgetExpiryDate: OrderSchema.budgetExpiryDate.optional(),
  assemblySchedulingDate: OrderSchema.assemblySchedulingDate.optional(),
  furnitureAssemblyDate: OrderSchema.furnitureAssemblyDate.optional(),
  items: OrderSchema.items.required(),
  comments: OrderSchema.comments.optional(),
  nfe: OrderSchema.nfe.optional(),
  serviceOrder: OrderSchema.serviceOrder.optional(),
  total: OrderSchema.total.required(),
  blueprint: OrderSchema.blueprint.optional(),
  discountTotal: OrderSchema.discountTotal.optional(),
  additionTotal: OrderSchema.additionTotal.optional(),
  discountTotalPercentage: OrderSchema.discountTotalPercentage.optional(),
  additionTotalPercentage: OrderSchema.additionTotalPercentage.optional(),
};

const create = createSchema(Joi.object().keys(createKeys));

const sortFields = ['code', '-code', 'date', '-date'];
const defaultField = '-code';
const filters: JoiSchemaMap<OrderFilter> = {
  client: OrderSchema.client.optional(),
  seller: OrderSchema.seller.optional(),
  intermediator: OrderSchema.intermediator.optional(),
  type: OrderSchema.type.optional(),
  status: OrderSchema.status.optional(),
  paymentPaid: orderPaymentKeys.paid.optional(),
};

const list = listSchema(sortFields, defaultField, filters);

const read = readSchema;

const updateKeys: JoiSchemaMap<UpdateOrderInput> = {
  type: OrderSchema.type.optional(),
  status: OrderSchema.status.optional(),
  payment: OrderSchema.payment.optional(),
  assemblySchedulingDate: OrderSchema.assemblySchedulingDate.optional(),
  furnitureAssemblyDate: OrderSchema.furnitureAssemblyDate.optional(),
  comments: OrderSchema.comments.optional(),
  nfe: OrderSchema.nfe.optional(),
  serviceOrder: OrderSchema.serviceOrder.optional(),
  blueprint: OrderSchema.blueprint.optional(),
  items: OrderSchema.items.optional(),
  total: OrderSchema.total.optional(),
  expectedDeliveryDate: OrderSchema.expectedDeliveryDate.optional(),
  budgetExpiryDate: OrderSchema.budgetExpiryDate.optional(),
  client: OrderSchema.client.optional(),
  sellerCommission: OrderSchema.sellerCommission.optional(),
  intermediator: OrderSchema.intermediator.optional(),
  intermediatorCommission: OrderSchema.intermediatorCommission.optional(),
  date: OrderSchema.date.optional(),
  deliveryTime: OrderSchema.deliveryTime.optional(),
  discountTotal: OrderSchema.discountTotal.optional(),
  additionTotal: OrderSchema.additionTotal.optional(),
  discountTotalPercentage: OrderSchema.discountTotalPercentage.optional(),
  additionTotalPercentage: OrderSchema.additionTotalPercentage.optional(),
};

const update = updateSchema(
  Joi.object()
    .keys(updateKeys)
    .or(
      'type',
      'status',
      'payment',
      'assemblySchedulingDate',
      'furnitureAssemblyDate',
      'comments',
      'nfe',
      'serviceOrder',
      'blueprint',
      'items',
      'total',
      'expectedDeliveryDate',
      'budgetExpiryDate',
      'client',
      'sellerCommission',
      'intermediator',
      'intermediatorCommission',
      'date',
      'deliveryTime',
      'discountTotal',
      'additionTotal',
      'discountTotalPercentage',
      'additionTotalPercentage',
    ),
);

const remove = removeSchema;

const duplicateBudget = readSchema;

export const resolvers = {
  createOrder: create,
  listOrders: list,
  readOrder: read,
  updateOrder: update,
  deleteOrder: remove,
  duplicateBudget,
};
