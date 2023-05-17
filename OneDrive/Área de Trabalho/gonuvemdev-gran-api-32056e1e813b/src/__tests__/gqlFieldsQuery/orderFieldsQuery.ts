import { adminFieldsQuery } from './adminFieldsQuery';
import { clientFieldsQuery } from './clientFieldsQuery';
import { employeeFieldsQuery } from './employeeFieldsQuery';
import { finishFieldsQuery } from './finishFieldsQuery';
import { productFieldsQuery } from './productFieldsQuery';

const orderEventFieldsQuery = `{
  status
  date
  description
}`;

const paymentInstallmentFieldsQuery = `{
  number
  value
  expiresAt
  paymentMethod
  comments
  incomingDate
}`;

const orderPaymentFieldsQuery = `{
  paid
  conditions
  date
  installments ${paymentInstallmentFieldsQuery}
}`;

const orderItemFieldsQuery = `{
  quantity
  description
  product ${productFieldsQuery}
  finish ${finishFieldsQuery}
  depth
  length
  price
  discount
  addition
  discountPercentage
  additionPercentage
  m2
  unitPrice
}`;

const orderBlueprintFieldsQuery = `{
  name
  url
}`;

export const orderFieldsQuery = `{
  _id
  code
  client ${clientFieldsQuery}
  seller ${adminFieldsQuery}
  sellerCommission
  intermediator ${employeeFieldsQuery}
  intermediatorCommission
  type
  date
  status
  events ${orderEventFieldsQuery}
  payment ${orderPaymentFieldsQuery}
  expectedDeliveryDate
  deliveryTime
  budgetExpiryDate
  assemblySchedulingDate
  furnitureAssemblyDate
  items ${orderItemFieldsQuery}
  comments
  nfe
  serviceOrder
  total
  blueprint ${orderBlueprintFieldsQuery}
  discountTotal
  additionTotal
  discountTotalPercentage
  additionTotalPercentage
  createdAt
  updatedAt
}`;
