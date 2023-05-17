import {
  AdminDoc,
  ClientDoc,
  DateInterval,
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
  ClosingOfCommissionBySellerOrder,
  ClosingOfCommissionBySeller,
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
    sellerCommission: number;
    sellerCommissionPercentage: number;
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
          sellerCommission: {
            $multiply: ['$sellerCommission', '$total', 0.0001],
          },
          sellerCommissionPercentage: '$sellerCommission',
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

const getClientNameById = (clients: ClientDoc[]) => (id: ID) => {
  const client = clients.find(c => isIDEqual(c._id, id));

  return client ? client.name || client.primaryPhone : 'Cliente não encontrado';
};

const createOrder = (clients: ClientDoc[]) => (
  order: OrdersBySeller['orders'][0],
): ClosingOfCommissionBySellerOrder => {
  return {
    ...order,
    clientName: getClientNameById(clients)(order.clientId),
    sellerCommission: Math.round(order.sellerCommission),
  };
};

const getOrdersCommissionSum = (orders: ClosingOfCommissionBySellerOrder[]) => {
  return orders.reduce((total, order) => total + order.sellerCommission, 0);
};

// eslint-disable-next-line max-lines-per-function
function createClosingOfCommissionBySeller(
  ordersBySeller: OrdersBySeller[],
  clients: ClientDoc[],
) {
  const findOrdersBySellerId = (seller: AdminDoc) =>
    ordersBySeller.find(s => isIDEqual(s._id.seller, seller._id));

  const createOneOrder = createOrder(clients);

  return (seller: AdminDoc): ClosingOfCommissionBySeller => {
    const sellerOrders = findOrdersBySellerId(seller);

    const orders = sellerOrders ? sellerOrders.orders.map(createOneOrder) : [];

    return {
      sellerId: seller._id,
      sellerName: (seller.user as UserDocument).name,
      orders,
      ordersCount: sellerOrders ? sellerOrders.ordersCount : 0,
      ordersTotalSum: sellerOrders ? sellerOrders.ordersTotalSum : 0,
      ordersCommissionSum: orders ? getOrdersCommissionSum(orders) : 0,
    };
  };
}

const sortSellersByNameAsc = (a: AdminDoc, b: AdminDoc) => {
  const userA = a.user as UserDoc;
  const userB = b.user as UserDoc;

  return userA.name.localeCompare(userB.name);
};

export async function getClosingOfCommissionsReportData(
  params: GetReportDataParams,
): Promise<ClosingOfCommissionBySeller[]> {
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
    .map(createClosingOfCommissionBySeller(ordersBySeller, clients));
}
