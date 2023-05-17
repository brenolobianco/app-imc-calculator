export const getBusinessStatisticsFieldsQuery = `
  numberOfAdmins
  numberOfClients
  numberOfEmployees
  numberOfEvents
  numberOfFinishes
  numberOfOrders
  numberOfBudgets
  numberOfProducts
  orderTotalsSum
  orderCount
  budgetToOrderConversionRate
  newClientsCount
  topSellingProducts {
    _id
    name
    totalM2
    total
  }
  topSellers {
    _id
    name
    total
    count
  }
  totalSalesByMonth {
    year
    month
    total
    count
  }
`;

const salesMapReportDataFieldsQuery = `{
  intermediatorId
  intermediatorName
  orders {
    code
    clientName
    date
    total
    sellerName
    sellerCommission
    sellerCommissionPercentage
    intermediatorCommission
    intermediatorCommissionPercentage
  }
}`;

const salesInThePeriodReportDataFieldsQuery = `{
  sellerId
  sellerName
  orders {
    code
    clientName
    date
    total
  }
  ordersCount
  ordersTotalSum
}`;

const closingOfCommissionsReportData = `
{
  sellerId
  sellerName
  orders {
    code
    clientName
    date
    total
    sellerCommission
    sellerCommissionPercentage
  }
  ordersCount
  ordersTotalSum
  ordersCommissionSum
}`;

const clientDebtBySellerReportData = `{
  sellerId
  sellerName
  orders {
    code
    clientName
    clientPhone
    date
    total
    payment
    balance
  }
  ordersCount
  ordersTotalSum
  ordersPaymentSum
  ordersBalanceSum
}`;

const productsForProductionReportData = `{
  productId
  productName
  orders {
    code
    sellerName
    clientName
    date
    measurementDate
    expectedDeliveryDate
    m2
  }
  ordersCount
  totalM2
}`;

export const getReportDataFieldsQuery = `
  salesMapReportData ${salesMapReportDataFieldsQuery}
  salesInThePeriodReportData  ${salesInThePeriodReportDataFieldsQuery}
  closingOfCommissionsReportData  ${closingOfCommissionsReportData}
  clientDebtBySellerReportData ${clientDebtBySellerReportData}
  productsForProductionReportData  ${productsForProductionReportData}
`;
