/* eslint-disable no-param-reassign */
import { OrderStatus } from '../../enums';
import {
  AdminDoc,
  ClientDoc,
  DateInterval,
  OrderDoc,
  ProductDoc,
  UserDoc,
} from '../../interfaces';
import Admin from '../../models/Admin';
import Client from '../../models/Client';
import Order from '../../models/Order';
import Product from '../../models/Product';
import { GetReportDataParams, ID, MyObject, SalesByProduct } from '../../types';
import { createFilterQuery } from '../../utils/filter';
import { isIDEqual } from '../../utils/general';

async function createFilters({ beginDate, endDate }: GetReportDataParams) {
  const filter = await createFilterQuery([
    {
      name: 'date',
      type: 'dateInterval',
      value: { beginDate, endDate } as DateInterval,
    },
    { name: 'type', type: 'string', value: 'order' },
  ]);

  return { ...filter, expectedDeliveryDate: { $gt: new Date(Date.now()) } };
}

async function getProducts(conditions = {}) {
  return Product.find(conditions, 'name').sort('name').lean();
}

async function getOrders(conditions: MyObject) {
  const projection =
    'code seller client date events expectedDeliveryDate m2 items';

  return Order.find(conditions, projection).lean();
}

async function getClients(ids: ID[]) {
  return Client.find({ _id: { $in: ids } }, 'name primaryPhone').lean();
}

async function getSellers(ids: ID[]) {
  return Admin.find({ _id: { $in: ids } }, 'user')
    .populate('user', 'name')
    .lean();
}

async function groupOrdersByProductId(orders: OrderDoc[]) {
  const initialValue: Record<string, OrderDoc[]> = {};

  return orders.reduce((prev, curr) => {
    curr.items.forEach(item => {
      const productId = (item.product as ID).toString();

      if (!prev[productId]) prev[productId] = [];

      if (!prev[productId].includes(curr)) prev[productId].push(curr);
    });

    return prev;
  }, initialValue);
}

// eslint-disable-next-line max-lines-per-function
async function getSalesByProduct({
  clients,
  sellers,
  products,
  ordersGrouppedByProductId,
}: {
  clients: ClientDoc[];
  sellers: AdminDoc[];
  products: ProductDoc[];
  ordersGrouppedByProductId: Record<string, OrderDoc[]>;
}): Promise<SalesByProduct[]> {
  const getSellerNameById = (id: string) => {
    const seller = sellers.find(s => isIDEqual(s._id, id));

    return seller ? (seller.user as UserDoc).name : 'Vendedor não encontrado';
  };

  const getClientNameById = (id: string) => {
    const client = clients.find(c => isIDEqual(c._id, id));

    return client
      ? client.name || client.primaryPhone
      : 'Cliente não encontrado';
  };

  const getOrderMeasurementDate = (order: OrderDoc) => {
    const measurement = order.events.find(
      event => event.status === OrderStatus.Measurement,
    );

    return measurement ? measurement.date : undefined;
  };

  const getProductOrders = (productId: string) => {
    return ordersGrouppedByProductId[productId] || [];
  };

  // eslint-disable-next-line max-lines-per-function
  const createSalesByProduct = (product: ProductDoc): SalesByProduct => {
    const productOrders = getProductOrders(product._id.toString());

    const prodOrders = productOrders.map(order => {
      return {
        code: order.code,
        sellerName: getSellerNameById((order.seller as ID).toString()),
        clientName: getClientNameById((order.client as ID).toString()),
        date: order.date,
        measurementDate: getOrderMeasurementDate(order),
        expectedDeliveryDate: order.expectedDeliveryDate,
        m2: order.items.reduce((m2, item) => {
          return !isIDEqual(item.product as ID, product._id)
            ? m2
            : m2 + item.m2;
        }, 0),
      };
    });

    return {
      productId: product._id,
      productName: product.name,
      orders: prodOrders,
      ordersCount: prodOrders.length,
      totalM2: prodOrders.reduce((total, order) => total + order.m2, 0),
    };
  };

  return products.map(createSalesByProduct);
}

async function getRefIdsFromOrders(orders: OrderDoc[]) {
  const initialValue = {
    productsIds: [] as ID[],
    clientsIds: [] as ID[],
    sellersIds: [] as ID[],
  };

  return orders.reduce((acc, order) => {
    acc.clientsIds.push(order.client as ID);
    acc.sellersIds.push(order.seller as ID);
    acc.productsIds.push(...order.items.map(item => item.product as ID));

    return acc;
  }, initialValue);
}

// eslint-disable-next-line max-lines-per-function
export async function getProductsForProductionReportData(
  params: GetReportDataParams,
): Promise<SalesByProduct[]> {
  const filter = await createFilters(params);

  const orders = await getOrders(filter);

  const { productsIds, clientsIds, sellersIds } = await getRefIdsFromOrders(
    orders,
  );

  const conditions = params.productsIds
    ? { _id: { $in: params.productsIds } }
    : { _id: { $in: productsIds } };

  const [
    clients,
    sellers,
    products,
    ordersGrouppedByProductId,
  ] = await Promise.all([
    getClients(clientsIds),
    getSellers(sellersIds),
    getProducts(conditions),
    groupOrdersByProductId(orders),
  ]);

  const salesByProduct = await getSalesByProduct({
    clients,
    sellers,
    products,
    ordersGrouppedByProductId,
  });

  return salesByProduct;
}
