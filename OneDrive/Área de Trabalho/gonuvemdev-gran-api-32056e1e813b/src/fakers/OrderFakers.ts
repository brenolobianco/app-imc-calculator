import {
  fakeArray,
  fakeBoolean,
  fakeDigitsString,
  fakeFutureDate,
  fakeId,
  fakeImage,
  fakePastDate,
  fakeRandomArrayElement,
  fakeRandomInt,
  fakeSentence,
  fakeWord,
} from './fakersUtils';
import {
  OrderBlueprint,
  OrderEvent,
  OrderInterface,
  OrderItem,
  OrderPayment,
  PaymentInstallment,
} from '../interfaces';
import { Fake } from '../types';
import { OrderStatus } from '../enums';

function fakeOrderEvent(): Required<OrderEvent> {
  return {
    status: fakeRandomArrayElement(Object.values(OrderStatus))(),
    date: fakePastDate(),
    description: fakeSentence(),
  };
}

function fakePaymentInstallment(): Required<PaymentInstallment> {
  return {
    number: fakeRandomInt({ min: 1, max: 10 })(),
    value: fakeRandomInt({ min: 100, max: 100000 })(),
    expiresAt: fakeFutureDate(),
    paymentMethod: fakeWord(),
    comments: fakeSentence(),
    incomingDate: fakeFutureDate(),
  };
}

function fakeOrderPayment(): Required<OrderPayment> {
  return {
    paid: fakeBoolean(),
    conditions: fakeSentence(),
    date: fakePastDate(),
    installments: fakeArray(fakePaymentInstallment, 3),
  };
}

function fakeOrderItem(): Required<OrderItem> {
  return {
    quantity: fakeRandomInt({ min: 1, max: 4 })(),
    description: fakeSentence(),
    product: fakeId(),
    finish: fakeId(),
    depth: fakeRandomInt({ min: 100, max: 2000 })(),
    length: fakeRandomInt({ min: 100, max: 2000 })(),
    price: fakeRandomInt({ min: 100, max: 300000 })(),
    discount: fakeRandomInt({ min: 0, max: 10000 })(),
    addition: fakeRandomInt({ min: 0, max: 10000 })(),
    discountPercentage: fakeRandomInt({ min: 0, max: 10000 })(),
    additionPercentage: fakeRandomInt({ min: 0, max: 10000 })(),
    m2: fakeRandomInt({ min: 0, max: 100000 })(),
    unitPrice: fakeRandomInt({ min: 100, max: 300000 })(),
  };
}

function fakeOrderBlueprint(): Required<OrderBlueprint> {
  return {
    name: fakeWord(),
    url: fakeImage(),
  };
}

export const fakeOrder: Fake<OrderInterface> = {
  code: fakeDigitsString(7),
  client: fakeId,
  seller: fakeId,
  sellerCommission: fakeRandomInt({ min: 0, max: 10000 }),
  intermediator: fakeId,
  intermediatorCommission: fakeRandomInt({ min: 0, max: 10000 }),
  type: fakeRandomArrayElement(['budget', 'order']),
  date: fakePastDate,
  status: fakeRandomArrayElement(Object.values(OrderStatus)),
  events: () => fakeArray(fakeOrderEvent, 2),
  payment: fakeOrderPayment,
  expectedDeliveryDate: fakeFutureDate,
  deliveryTime: fakeRandomInt({ min: 5, max: 20 }),
  budgetExpiryDate: fakeFutureDate,
  assemblySchedulingDate: fakeFutureDate,
  furnitureAssemblyDate: fakePastDate,
  items: () => fakeArray(fakeOrderItem, 3),
  comments: fakeSentence,
  nfe: fakeImage,
  serviceOrder: () => fakeArray(fakeImage, 3),
  total: fakeRandomInt({ min: 100, max: 300000 }),
  blueprint: () => fakeArray(fakeOrderBlueprint, 3),
  discountTotal: fakeRandomInt({ min: 0, max: 10000 }),
  additionTotal: fakeRandomInt({ min: 0, max: 10000 }),
  discountTotalPercentage: fakeRandomInt({ min: 0, max: 10000 }),
  additionTotalPercentage: fakeRandomInt({ min: 0, max: 10000 }),
};
