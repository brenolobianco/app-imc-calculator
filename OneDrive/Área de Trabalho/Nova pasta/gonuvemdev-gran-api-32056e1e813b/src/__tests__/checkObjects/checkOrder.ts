/* eslint-disable max-lines-per-function */
import { checkEmployee, checkFinish, checkProduct } from '.';
import {
  AdminInterface,
  ClientInterface,
  EmployeeInterface,
  FinishInterface,
  OrderBlueprint,
  OrderEvent,
  OrderInterface,
  OrderItem,
  OrderPayment,
  PaymentInstallment,
  ProductInterface,
} from '../../interfaces';
import { checkAdmin } from './checkAdmin';
import { checkClient } from './checkClient';
import { getISODateString } from './general';

function checkOrderItem(expected: OrderItem, received: OrderItem) {
  type omitKeys = 'product' | 'finish';

  expect(received).toMatchObject<Omit<Required<OrderItem>, omitKeys>>({
    depth: expected.depth,
    description: expected.description,
    length: expected.length,
    price: expected.price,
    quantity: expected.quantity,
    discount: expected.discount as number,
    addition: expected.addition as number,
    discountPercentage: expected.discountPercentage as number,
    additionPercentage: expected.additionPercentage as number,
    m2: expected.m2,
    unitPrice: expected.unitPrice,
  });

  checkProduct(
    expected.product as Required<ProductInterface>,
    received.product as ProductInterface,
  );

  checkFinish(
    expected.finish as Required<FinishInterface>,
    received.finish as FinishInterface,
  );
}

function checkOrderEvent(expected: OrderEvent, received: OrderEvent) {
  type omitKeys = 'date';

  expect(received).toMatchObject<Omit<Required<OrderEvent>, omitKeys>>({
    status: expected.status,
    description: expected.description as string,
  });

  // expect(received.date).toBe(getISODateString(expected.date));
}

function checkPaymentInstallment(
  expected: PaymentInstallment,
  received: PaymentInstallment,
) {
  type omitKeys = 'expiresAt' | 'incomingDate';

  expect(received).toMatchObject<Omit<Required<PaymentInstallment>, omitKeys>>({
    number: expected.number,
    value: expected.value,
    paymentMethod: expected.paymentMethod as string,
    comments: expected.comments as string,
  });

  expect(received.expiresAt).toBe(getISODateString(expected.expiresAt));

  expect(received.incomingDate).toBe(
    getISODateString(expected.incomingDate as Date),
  );
}

function checkOrderPayment(expected: OrderPayment, received: OrderPayment) {
  type omitKeys = 'date' | 'installments';

  expect(received).toMatchObject<Omit<Required<OrderPayment>, omitKeys>>({
    paid: expected.paid,
    conditions: expected.conditions as string,
  });

  expect(received.date).toBe(getISODateString(expected.date as Date));

  // eslint-disable-next-line no-unused-expressions
  received.installments?.forEach((installment, i) => {
    if (expected.installments) {
      checkPaymentInstallment(expected.installments[i], installment);
    }
  });
}

function checkOrderBlueprint(
  expected: OrderBlueprint,
  received: OrderBlueprint,
) {
  type omitKeys = '';

  expect(received).toMatchObject<Omit<Required<OrderBlueprint>, omitKeys>>({
    name: expected.name,
    url: expected.url,
  });
}

export const checkOrder = (
  expected: Required<OrderInterface>,
  received: OrderInterface,
): void => {
  type omitKeys =
    | 'date'
    | 'expectedDeliveryDate'
    | 'budgetExpiryDate'
    | 'assemblySchedulingDate'
    | 'furnitureAssemblyDate'
    | 'client'
    | 'seller'
    | 'intermediator'
    | 'items'
    | 'serviceOrder'
    | 'events'
    | 'payment'
    | 'blueprint';

  expect(received).toMatchObject<Omit<Required<OrderInterface>, omitKeys>>({
    code: expected.code,
    sellerCommission: expected.sellerCommission,
    intermediatorCommission: expected.intermediatorCommission,
    type: expected.type,
    status: expected.status,
    deliveryTime: expected.deliveryTime,
    comments: expected.comments,
    nfe: expected.nfe,
    total: expected.total,
    discountTotal: expected.discountTotal as number,
    additionTotal: expected.additionTotal as number,
    discountTotalPercentage: expected.discountTotalPercentage as number,
    additionTotalPercentage: expected.additionTotalPercentage as number,
  });

  checkClient(
    expected.client as Required<ClientInterface>,
    received.client as ClientInterface,
  );

  checkAdmin(
    expected.seller as Required<AdminInterface>,
    received.seller as AdminInterface,
  );

  checkEmployee(
    expected.intermediator as Required<EmployeeInterface>,
    received.intermediator as EmployeeInterface,
  );

  received.items.forEach((item, i) => checkOrderItem(expected.items[i], item));

  // eslint-disable-next-line no-unused-expressions
  received.serviceOrder?.forEach((img, i) =>
    expect(img).toBe(expected.serviceOrder[i] as string),
  );
  // eslint-disable-next-line no-unused-expressions
  received.blueprint?.forEach((blueprint, i) =>
    checkOrderBlueprint(expected.blueprint[i], blueprint),
  );

  received.events.forEach((event, i) =>
    checkOrderEvent(expected.events[i], event),
  );

  checkOrderPayment(expected.payment, received.payment as OrderPayment);

  expect(received).toMatchObject({
    date: getISODateString(expected.date),
    expectedDeliveryDate: getISODateString(expected.expectedDeliveryDate),
    budgetExpiryDate: getISODateString(expected.budgetExpiryDate),
    assemblySchedulingDate: getISODateString(expected.assemblySchedulingDate),
    furnitureAssemblyDate: getISODateString(expected.furnitureAssemblyDate),
  });
};
