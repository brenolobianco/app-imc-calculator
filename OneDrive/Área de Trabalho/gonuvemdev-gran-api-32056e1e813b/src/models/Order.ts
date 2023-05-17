/* eslint-disable max-lines */
import mongoose, { SchemaDefinition } from 'mongoose';

import { OrderStatus } from '../enums';
import {
  OrderBlueprint,
  OrderDocument,
  OrderEvent,
  OrderInterface,
  OrderItem,
  OrderPayment,
  PaymentInstallment,
} from '../interfaces';
import { MongooseDefinition } from '../types';

import './Admin';
import './Client';
import './Employee';
import './Finish';
import './Product';

const orderEventsDefinition: MongooseDefinition<OrderEvent> = {
  status: {
    type: String,
    enum: Object.values(OrderStatus),
    required: true,
  },
  date: {
    type: Date,
    required: true,
  },
  description: String,
};

const OrderEventsSchema = new mongoose.Schema(
  orderEventsDefinition as SchemaDefinition,
  { _id: false },
);

const paymentInstallmentDefinition: MongooseDefinition<PaymentInstallment> = {
  number: {
    type: Number,
    validate: Number.isInteger,
    required: true,
  },
  value: {
    type: Number,
    validate: Number.isInteger,
    required: true,
  },
  expiresAt: {
    type: Date,
    required: true,
  },
  paymentMethod: String,
  comments: String,
  incomingDate: Date,
};

const PaymentInstallmentSchema = new mongoose.Schema(
  paymentInstallmentDefinition as SchemaDefinition,
  { _id: false },
);

const orderPaymentDefinition: MongooseDefinition<OrderPayment> = {
  paid: {
    type: Boolean,
    required: true,
  },
  conditions: String,
  date: Date,
  installments: [PaymentInstallmentSchema],
};

const OrderPaymentSchema = new mongoose.Schema(
  orderPaymentDefinition as SchemaDefinition,
  { _id: false },
);

const orderItemsDefinition: MongooseDefinition<OrderItem> = {
  quantity: {
    type: Number,
    validate: Number.isInteger,
    required: true,
  },
  description: {
    type: String,
    required: true,
  },
  product: {
    type: mongoose.Types.ObjectId,
    ref: 'Product',
    required: true,
  },
  finish: {
    type: mongoose.Types.ObjectId,
    ref: 'Finish',
    required: true,
  },
  depth: {
    type: Number,
    validate: Number.isInteger,
    required: true,
  },
  length: {
    type: Number,
    validate: Number.isInteger,
    required: true,
  },
  price: {
    type: Number,
    validate: Number.isInteger,
    required: true,
  },
  discount: {
    type: Number,
    validate: Number.isInteger,
    default: 0,
  },
  addition: {
    type: Number,
    validate: Number.isInteger,
    default: 0,
  },
  discountPercentage: {
    type: Number,
    validate: Number.isInteger,
    default: 0,
  },
  additionPercentage: {
    type: Number,
    validate: Number.isInteger,
    default: 0,
  },
  m2: {
    type: Number,
    validate: Number.isInteger,
    required: true,
  },
  unitPrice: {
    type: Number,
    validate: Number.isInteger,
    required: true,
  },
};

const OrderItemsSchema = new mongoose.Schema(
  orderItemsDefinition as SchemaDefinition,
  { _id: false },
);

const orderBlueprintDefinition: MongooseDefinition<OrderBlueprint> = {
  name: {
    type: String,
    required: true,
  },
  url: {
    type: String,
    required: true,
  },
};

const OrderBlueprintSchema = new mongoose.Schema(
  orderBlueprintDefinition as SchemaDefinition,
  { _id: false },
);

const definition: MongooseDefinition<OrderInterface> = {
  code: {
    type: String,
    unique: true,
    required: true,
  },
  client: {
    type: mongoose.Types.ObjectId,
    ref: 'Client',
    required: true,
  },
  seller: {
    type: mongoose.Types.ObjectId,
    ref: 'Admin',
    required: true,
  },
  sellerCommission: {
    type: Number,
    validate: Number.isInteger,
    required: true,
  },
  intermediator: {
    type: mongoose.Types.ObjectId,
    ref: 'Employee',
  },
  intermediatorCommission: {
    type: Number,
    validate: Number.isInteger,
  },
  type: {
    type: String,
    enum: ['budget', 'order'],
    required: true,
  },
  date: {
    type: Date,
    required: true,
  },
  status: {
    type: String,
    enum: Object.values(OrderStatus),
    required: true,
  },
  events: [
    {
      type: OrderEventsSchema,
      required: true,
    },
  ],
  payment: OrderPaymentSchema,
  expectedDeliveryDate: Date,
  deliveryTime: {
    type: Number,
    validate: Number.isInteger,
  },
  budgetExpiryDate: Date,
  assemblySchedulingDate: Date,
  furnitureAssemblyDate: Date,
  items: [
    {
      type: OrderItemsSchema,
      required: true,
    },
  ],
  comments: String,
  nfe: String,
  serviceOrder: [String],
  total: {
    type: Number,
    validate: Number.isInteger,
    required: true,
  },
  blueprint: [OrderBlueprintSchema],
  discountTotal: {
    type: Number,
    validate: Number.isInteger,
    default: 0,
  },
  additionTotal: {
    type: Number,
    validate: Number.isInteger,
    default: 0,
  },
  discountTotalPercentage: {
    type: Number,
    validate: Number.isInteger,
    default: 0,
  },
  additionTotalPercentage: {
    type: Number,
    validate: Number.isInteger,
    default: 0,
  },
};

const OrderSchema = new mongoose.Schema(definition as SchemaDefinition, {
  timestamps: true,
});

const Order = mongoose.model<OrderDocument>('Order', OrderSchema);

export default Order;
