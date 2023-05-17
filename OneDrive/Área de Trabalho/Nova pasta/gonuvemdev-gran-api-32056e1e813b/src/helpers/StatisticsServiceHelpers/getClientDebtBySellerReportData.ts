import {
  AdminDoc,
  ClientDoc,
  DateInterval,
  OrderPayment,
  UserDoc,
  UserDocument,
} from '../../interfaces';
import Admin from '../../models/Admin';
import Client from '../../models/Client';
import Order from '../../models/Order';
import {
  GetReportDataParams,
  ID,
  MyObject,
  ClientDebtBySellerOrder,
  ClientDebtBySeller,
} from '../../types';
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

  return filter;
}

type OrdersBySeller = {
  _id: { seller: ID };
  orders: {
    code: string;
    clientId: string;
    date: Date;
    total: number;
    payment?: OrderPayment;
  }[];
  ordersCount: number;
  ordersTotalSum: number;
};

// eslint-disable-next-line max-lines-per-function
async function getOrdersBySeller(filter: MyObject): Promise<OrdersBySeller[]> {
  return Order.aggregate()
    .match(filter)
    .group({
      _id: { seller: '$seller' },
      orders: {
        $push: {
          code: '$code',
          clientId: '$client',
          date: '$date',
          total: '$total',
          payment: '$payment',
        },
      },
      ordersCount: { $sum: 1 },
      ordersTotalSum: { $sum: '$total' },
    });
}

async function getClients(ordersBySeller: OrdersBySeller[]) {
  const clientsIds = ordersBySeller.flatMap(seller =>
    seller.orders.map(order => order.clientId),
  );

  return Client.find({ _id: { $in: clientsIds } }, 'name primaryPhone').lean();
}

async function getSellers(conditions = {}) {
  return Admin.find(conditions, 'user').populate('user', 'name').lean();
}

const getClientById = (clients: ClientDoc[]) => (id: ID) => {
  return clients.find(c => isIDEqual(c._id, id));
};

const getPaymentTotal = (order: OrdersBySeller['orders'][0]) => {
  const { payment } = order;
  if (!payment) return 0;

  const { installments } = payment;
  if (!installments) return 0;

  return installments.reduce((total, installment) => {
    return installment.incomingDate ? total + installment.value : total;
  }, 0);
};

const createOrder = (clients: ClientDoc[]) => (
  order: OrdersBySeller['orders'][0],
): ClientDebtBySellerOrder => {
  const client = getClientById(clients)(order.clientId);

  const paymentTotal = getPaymentTotal(order);

  return {
    ...order,
    clientName: client
      ? client.name || client.primaryPhone
      : 'Cliente não encontrado',
    clientPhone: client ? client.primaryPhone : 'Cliente não encontrado',
    payment: paymentTotal,
    balance: order.total - paymentTotal,
  };
};

const sumOrdersPayment = (sum: number, order: OrdersBySeller['orders'][0]) => {
  return sum + getPaymentTotal(order);
};

function isOrderWithNonZeroBalance(order: ClientDebtBySellerOrder) {
  return order.balance !== 0;
}

// eslint-disable-next-line max-lines-per-function
function createClientDebtBySeller(
  ordersBySeller: OrdersBySeller[],
  clients: ClientDoc[],
) {
  const findOrdersBySellerId = (seller: AdminDoc) =>
    ordersBySeller.find(s => isIDEqual(s._id.seller, seller._id));

  const createOneOrder = createOrder(clients);

  // eslint-disable-next-line max-lines-per-function
  return (seller: AdminDoc): ClientDebtBySeller => {
    const sellerOrders = findOrdersBySellerId(seller);

    const orders = sellerOrders ? sellerOrders.orders.map(createOneOrder) : [];

    const total = sellerOrders ? sellerOrders.ordersTotalSum : 0;

    const payment = sellerOrders
      ? sellerOrders.orders.reduce(sumOrdersPayment, 0)
      : 0;

    return {
      sellerId: seller._id,
      sellerName: (seller.user as UserDocument).name,
      orders: orders.filter(isOrderWithNonZeroBalance),
      ordersCount: sellerOrders ? sellerOrders.ordersCount : 0,
      ordersTotalSum: total,
      ordersPaymentSum: payment,
      ordersBalanceSum: total - payment,
    };
  };
}

const sortSellersByNameAsc = (a: AdminDoc, b: AdminDoc) => {
  const userA = a.user as UserDoc;
  const userB = b.user as UserDoc;

  return userA.name.localeCompare(userB.name);
};

export async function getClientDebtBySellerReportData(
  params: GetReportDataParams,
): Promise<ClientDebtBySeller[]> {
  const filter = await createFilters(params);

  const ordersBySeller = await getOrdersBySeller(filter);

  const conditions = params.sellersIds
    ? { _id: { $in: params.sellersIds } }
    : { _id: { $in: ordersBySeller.map(({ _id }) => _id.seller) } };

  const [clients, sellers] = await Promise.all([
    getClients(ordersBySeller),
    getSellers(conditions),
  ]);

  return sellers
    .sort(sortSellersByNameAsc)
    .map(createClientDebtBySeller(ordersBySeller, clients));
}
