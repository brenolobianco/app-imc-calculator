import {
  AdminDoc,
  ClientDoc,
  DateInterval,
  EmployeeDoc,
  UserDoc,
} from '../../interfaces';
import Admin from '../../models/Admin';
import Client from '../../models/Client';
import Employee from '../../models/Employee';
import Order from '../../models/Order';
import {
  GetReportDataParams,
  ID,
  MyObject,
  SalesMapByIntermediator,
  SalesMapByIntermediatorOrder,
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

type OrdersByIntermediator = {
  _id: { intermediator?: ID };
  orders: {
    code: string;
    clientId: string;
    date: Date;
    total: number;
    sellerId: ID;
    sellerCommission: number;
    sellerCommissionPercentage: number;
    intermediatorCommission: number;
    intermediatorCommissionPercentage?: number;
  }[];
};

// eslint-disable-next-line max-lines-per-function
async function getOrdersByIntermediator(
  filter: MyObject,
): Promise<OrdersByIntermediator[]> {
  return Order.aggregate()
    .match(filter)
    .group({
      _id: { intermediator: '$intermediator' },
      orders: {
        $push: {
          code: '$code',
          clientId: '$client',
          date: '$date',
          total: '$total',
          sellerId: '$seller',
          sellerCommission: {
            $multiply: ['$sellerCommission', '$total', 0.0001],
          },
          sellerCommissionPercentage: '$sellerCommission',
          intermediatorCommission: {
            $multiply: ['$intermediatorCommission', '$total', 0.0001],
          },
          intermediatorCommissionPercentage: '$intermediatorCommission',
        },
      },
    });
}

async function getClients(ordersByIntermediator: OrdersByIntermediator[]) {
  const ids = ordersByIntermediator.flatMap(intermediator =>
    intermediator.orders.map(order => order.clientId),
  );

  return Client.find({ _id: { $in: ids } }, 'name primaryPhone').lean();
}

async function getSellers(ordersByIntermediator: OrdersByIntermediator[]) {
  const ids = ordersByIntermediator.flatMap(intermediator =>
    intermediator.orders.map(order => order.sellerId),
  );

  return Admin.find({ _id: { $in: ids } }, 'user')
    .populate('user', 'name')
    .lean();
}

async function getIntermediators(conditions = {}) {
  return Employee.find(conditions, 'name').lean();
}

const getClientNameById = (clients: ClientDoc[]) => (id: ID) => {
  const client = clients.find(c => isIDEqual(c._id, id));

  return client ? client.name || client.primaryPhone : 'Cliente não encontrado';
};

const getSellerNameById = (sellers: AdminDoc[]) => (id: ID) => {
  const seller = sellers.find(c => isIDEqual(c._id, id));

  return seller ? (seller.user as UserDoc).name : 'Vendedor não encontrado';
};

const createOrder = (clients: ClientDoc[], sellers: AdminDoc[]) => (
  order: OrdersByIntermediator['orders'][0],
): SalesMapByIntermediatorOrder => {
  return {
    ...order,
    sellerName: getSellerNameById(sellers)(order.sellerId),
    clientName: getClientNameById(clients)(order.clientId),
    sellerCommission: Math.round(order.sellerCommission),
    intermediatorCommission: Math.round(order.intermediatorCommission),
    intermediatorCommissionPercentage:
      order.intermediatorCommissionPercentage || 0,
  };
};

// eslint-disable-next-line max-lines-per-function
function createSalesByIntermediator(
  ordersByIntermediator: OrdersByIntermediator[],
  clients: ClientDoc[],
  sellers: AdminDoc[],
) {
  const findOrdersByIntermediatorId = (id: ID) =>
    ordersByIntermediator.find(s => isIDEqual(s._id.intermediator || '', id));

  const createOneOrder = createOrder(clients, sellers);

  return (intermediator: EmployeeDoc) => {
    const intermediatorOrders = findOrdersByIntermediatorId(intermediator._id);

    const orders = intermediatorOrders
      ? intermediatorOrders.orders.map(createOneOrder)
      : [];

    return {
      intermediatorId: intermediator._id,
      intermediatorName: intermediator.name,
      orders,
    };
  };
}

const sortIntermediatorsByNameAsc = (a: EmployeeDoc, b: EmployeeDoc) => {
  return a.name.localeCompare(b.name);
};

// eslint-disable-next-line max-lines-per-function
export async function getSalesMapReportData(
  params: GetReportDataParams,
): Promise<SalesMapByIntermediator[]> {
  const filter = await createFilters(params);

  const ordersByIntermediator = await getOrdersByIntermediator(filter);

  const ids = ordersByIntermediator.map(({ _id }) => _id.intermediator);
  const conditions = params.intermediatorsIds
    ? { _id: { $in: params.intermediatorsIds } }
    : { _id: { $in: ids } };

  const [clients, sellers, intermediators] = await Promise.all([
    getClients(ordersByIntermediator),
    getSellers(ordersByIntermediator),
    getIntermediators(conditions),
  ]);

  const ordersWithoutIntermediator = ordersByIntermediator.find(
    order => order._id.intermediator === null,
  );

  return [
    ...intermediators
      .sort(sortIntermediatorsByNameAsc)
      .map(createSalesByIntermediator(ordersByIntermediator, clients, sellers)),
    {
      intermediatorName: 'Vendas sem intermediário',
      orders: ordersWithoutIntermediator
        ? ordersWithoutIntermediator.orders.map(createOrder(clients, sellers))
        : [],
    },
  ];
}
