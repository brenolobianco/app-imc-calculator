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
  SalesBySeller,
  SalesBySellerOrder,
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
  orders: { code: string; clientId: string; date: Date; total: number }[];
  ordersCount: number;
  ordersTotalSum: number;
};

async function getOrdersBySeller(filter: MyObject) {
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

// eslint-disable-next-line max-lines-per-function
function createSalesBySeller(
  ordersBySeller: OrdersBySeller[],
  clients: ClientDoc[],
) {
  const findOrdersBySellerId = (seller: AdminDoc) =>
    ordersBySeller.find(s => isIDEqual(s._id.seller, seller._id));

  const createOrder = (
    order: OrdersBySeller['orders'][0],
  ): SalesBySellerOrder => {
    const client = clients.find(c => isIDEqual(c._id, order.clientId));
    return {
      ...order,
      clientName: client
        ? client.name || client.primaryPhone
        : 'Cliente não encontrado',
    };
  };

  return (seller: AdminDoc) => {
    const sellerOrders = findOrdersBySellerId(seller);

    const orders = sellerOrders ? sellerOrders.orders.map(createOrder) : [];

    return {
      sellerId: seller._id,
      sellerName: (seller.user as UserDocument).name,
      orders,
      ordersCount: sellerOrders ? sellerOrders.ordersCount : 0,
      ordersTotalSum: sellerOrders ? sellerOrders.ordersTotalSum : 0,
    };
  };
}

const sortSellersByNameAsc = (a: AdminDoc, b: AdminDoc) => {
  const userA = a.user as UserDoc;
  const userB = b.user as UserDoc;

  return userA.name.localeCompare(userB.name);
};

export async function getSalesInThePeriodReportData(
  params: GetReportDataParams,
): Promise<SalesBySeller[]> {
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
    .map(createSalesBySeller(ordersBySeller, clients));
}
