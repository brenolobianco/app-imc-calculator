import {
  ClientDebtBySeller,
  ClosingOfCommissionBySeller,
  SalesByProduct,
  SalesBySeller,
  SalesBySellerOrder,
  SalesMapByIntermediator,
} from '../../types';

export const checkSalesBySellerOrder = (
  expected: Partial<SalesBySellerOrder>,
  received: SalesBySellerOrder,
): void => {
  type omitKeys = 'code' | 'date';

  expect(received).toMatchObject<Omit<Required<SalesBySellerOrder>, omitKeys>>({
    clientName: expected.clientName as string,
    total: expected.total as number,
  });
};

export const checkSalesBySeller = (
  expected: Partial<SalesBySeller>,
  received: SalesBySeller,
): void => {
  type omitKeys = 'sellerId' | 'orders';

  expect(received).toMatchObject<Omit<Required<SalesBySeller>, omitKeys>>({
    sellerName: expected.sellerName as string,
    ordersCount: expected.ordersCount as number,
    ordersTotalSum: expected.ordersTotalSum as number,
  });
};

export const checkSalesByProduct = (
  expected: Partial<SalesByProduct>,
  received: SalesByProduct,
): void => {
  type omitKeys = 'productId' | 'orders';

  expect(received).toMatchObject<Omit<Required<SalesByProduct>, omitKeys>>({
    productName: expected.productName as string,
    totalM2: expected.totalM2 as number,
    ordersCount: expected.ordersCount as number,
  });
};

export const checkSalesMapByIntermediator = (
  expected: Partial<SalesMapByIntermediator>,
  received: SalesMapByIntermediator,
): void => {
  type omitKeys = 'intermediatorId' | 'orders';

  expect(received).toMatchObject<
    Omit<Required<SalesMapByIntermediator>, omitKeys>
  >({
    intermediatorName: expected.intermediatorName as string,
  });
};

export const checkClientDebtBySeller = (
  expected: Partial<ClientDebtBySeller>,
  received: ClientDebtBySeller,
): void => {
  type omitKeys = 'sellerId' | 'orders';

  expect(received).toMatchObject<Omit<Required<ClientDebtBySeller>, omitKeys>>({
    ordersBalanceSum: expected.ordersBalanceSum as number,
    ordersPaymentSum: expected.ordersPaymentSum as number,
    sellerName: expected.sellerName as string,
    ordersCount: expected.ordersCount as number,
    ordersTotalSum: expected.ordersTotalSum as number,
  });
};

export const checkClosingOfCommissionBySeller = (
  expected: Partial<ClosingOfCommissionBySeller>,
  received: ClosingOfCommissionBySeller,
): void => {
  type omitKeys = 'sellerId' | 'orders';

  expect(received).toMatchObject<
    Omit<Required<ClosingOfCommissionBySeller>, omitKeys>
  >({
    ordersCommissionSum: expected.ordersCommissionSum as number,
    sellerName: expected.sellerName as string,
    ordersCount: expected.ordersCount as number,
    ordersTotalSum: expected.ordersTotalSum as number,
  });
};
