/* eslint-disable max-lines */
/* eslint-disable max-lines-per-function */
import { AdminDoc, OrderDoc, ProductDoc, UserDoc } from '../../interfaces';
import Admin from '../../models/Admin';
import Order from '../../models/Order';
import Product from '../../models/Product';
import { countAdminsTotal } from '../../services/AdminServices';
import {
  countClientsByCriteria,
  countClientsTotal,
} from '../../services/ClientServices';
import { countEmployeesTotal } from '../../services/EmployeeServices';
import { countEventsTotal } from '../../services/EventServices';
import { countFinishesTotal } from '../../services/FinishServices';
import { countOrdersByCriteria } from '../../services/OrderServices';
import { countProductsTotal } from '../../services/ProductServices';
import {
  GetBusinessStatisticsParams,
  GetBusinessStatisticsResponse,
  ID,
  MyObject,
  SalesByMonth,
  TopSeller,
  TopSellingProduct,
} from '../../types';
import { groupBy, isIDEqual } from '../../utils/general';

async function countDocumentsFromEnts() {
  const [
    numberOfAdmins,
    numberOfBudgets,
    numberOfClients,
    numberOfEmployees,
    numberOfEvents,
    numberOfFinishes,
    numberOfOrders,
    numberOfProducts,
  ] = await Promise.all([
    countAdminsTotal(),
    countOrdersByCriteria({ criteria: { type: 'budget' } }),
    countClientsTotal(),
    countEmployeesTotal(),
    countEventsTotal(),
    countFinishesTotal(),
    countOrdersByCriteria({ criteria: { type: 'order' } }),
    countProductsTotal(),
  ]);

  return {
    numberOfAdmins,
    numberOfBudgets,
    numberOfClients,
    numberOfEmployees,
    numberOfEvents,
    numberOfFinishes,
    numberOfOrders,
    numberOfProducts,
  };
}

async function getOrders({ beginDate, endDate }: GetBusinessStatisticsParams) {
  return Order.find(
    { date: { $gte: beginDate, $lte: endDate }, type: 'order' },
    {
      type: true,
      total: true,
      date: true,
      seller: true,
      'items.product': true,
      'items.depth': true,
      'items.length': true,
      'items.price': true,
      'items.discount': true,
      'items.addition': true,
      'items.m2': true,
    },
  ).lean();
}

async function getOrderStatistics(
  orders: OrderDoc[],
): Promise<
  Pick<GetBusinessStatisticsResponse, 'orderTotalsSum' | 'orderCount'>
> {
  const initialValue = { orderTotalsSum: 0, orderCount: 0 };

  return orders.reduce((statistics, order) => {
    return {
      orderTotalsSum: statistics.orderTotalsSum + order.total,
      orderCount: statistics.orderCount + 1,
    };
  }, initialValue);
}

async function countNewClients({
  beginDate,
  endDate,
}: GetBusinessStatisticsParams): Promise<
  GetBusinessStatisticsResponse['newClientsCount']
> {
  return countClientsByCriteria({
    criteria: { createdAt: { $gte: beginDate, $lte: endDate } },
  });
}

async function getTopSellers(
  orders: OrderDoc[],
  sellers: AdminDoc[],
): Promise<TopSeller[]> {
  try {
    const groupedOrdersBySeller = groupBy(orders, ({ seller }) =>
      seller.toString(),
    );

    const getSellerById = (id: string) => {
      return sellers.find(seller => isIDEqual(seller._id, id));
    };

    return Object.keys(groupedOrdersBySeller)
      .map(sellerId => {
        const sellerOrders = groupedOrdersBySeller[sellerId];

        const acc = sellerOrders.reduce(
          (prev, order) => {
            return { total: prev.total + order.total, count: prev.count + 1 };
          },
          { total: 0, count: 0 },
        );

        const seller = getSellerById((sellerOrders[0].seller as ID).toString());

        return {
          _id: sellerId,
          name: seller
            ? (seller.user as UserDoc).name
            : 'Vendedor não encontrado',
          total: acc.total,
          count: acc.count,
        };
      })
      .sort((a, b) => b.total - a.total);
  } catch (error) {
    return [{ _id: error.message, name: 'Erro', count: 0, total: 0 }];
  }
}

async function getTopSellingProducts(
  orders: OrderDoc[],
  products: ProductDoc[],
): Promise<TopSellingProduct[]> {
  try {
    const getProductById = (id: string) => {
      return products.find(product => isIDEqual(product._id, id));
    };

    const productsData = orders.flatMap(order => {
      return order.items.map(item => {
        const product = getProductById((item.product as ID).toString());

        return {
          _id: product ? product._id.toString() : '',
          name: product ? product.name : 'Produto não encontrado',
          value: item.price + (item.addition || 0) - (item.discount || 0),
          m2: item.m2,
        };
      });
    });

    const grouppedProductsData = groupBy(productsData, data => data._id);

    return Object.keys(grouppedProductsData)
      .map(productId => {
        const productData = grouppedProductsData[productId];

        const acc = productData.reduce(
          (prev, product) => {
            return {
              total: prev.total + product.value,
              totalM2: prev.totalM2 + product.m2,
            };
          },
          { total: 0, totalM2: 0 },
        );

        return {
          _id: productId,
          name: productData[0].name,
          total: acc.total,
          totalM2: acc.totalM2,
        };
      })
      .sort((a, b) => b.totalM2 - a.totalM2);
  } catch (error) {
    return [{ _id: error.message, name: 'Erro', total: 0, totalM2: 0 }];
  }
}

async function calculateBudgetToOrderConversionRate(
  ordersCount: number,
  { beginDate, endDate }: GetBusinessStatisticsParams,
): Promise<GetBusinessStatisticsResponse['budgetToOrderConversionRate']> {
  const budgetsCount = await countOrdersByCriteria({
    criteria: { type: 'budget', date: { $gte: beginDate, $lte: endDate } },
  });

  return ordersCount <= 0 ? 0 : budgetsCount / ordersCount;
}

async function getTotalSalesByMonth({
  graphBeginDate,
  graphEndDate,
}: Pick<
  GetBusinessStatisticsParams,
  'graphBeginDate' | 'graphEndDate'
>): Promise<SalesByMonth[]> {
  const dateExpression = { date: '$date', timezone: 'America/Fortaleza' };

  const dateFilter = !(graphBeginDate && graphEndDate)
    ? {}
    : { date: { $gte: graphBeginDate, $lte: graphEndDate } };

  return Order.aggregate()
    .match({ type: 'order', ...dateFilter })
    .project({
      y: { $year: dateExpression },
      m: { $month: dateExpression },
      t: '$total',
    })
    .group({
      _id: { year: '$y', month: '$m' },
      count: { $sum: 1 },
      total: { $sum: '$t' },
    })
    .sort({ '_id.year': 1, '_id.month': 1 })
    .project({
      year: '$_id.year',
      month: '$_id.month',
      count: '$count',
      total: '$total',
    });
}

async function getSellers(conditions: MyObject) {
  return Admin.find(conditions, 'user').populate('user', 'name').lean();
}

async function getProducts(conditions: MyObject) {
  return Product.find(conditions, 'name').lean();
}

export async function getBusinessStatistics({
  beginDate,
  endDate,
  graphBeginDate,
  graphEndDate,
}: GetBusinessStatisticsParams): Promise<GetBusinessStatisticsResponse> {
  const [
    documentsCountByEnt,
    orders,
    newClientsCount,
    totalSalesByMonth,
  ] = await Promise.all([
    countDocumentsFromEnts(),
    getOrders({ beginDate, endDate }),
    countNewClients({ beginDate, endDate }),
    getTotalSalesByMonth({ graphBeginDate, graphEndDate }),
  ]);

  const initialValue = { sellersIds: [] as ID[], productsIds: [] as ID[] };
  const { sellersIds, productsIds } = orders.reduce((acc, order) => {
    acc.sellersIds.push(order.seller as ID);
    acc.productsIds.push(...order.items.map(({ product }) => product as ID));
    return acc;
  }, initialValue);

  const [sellers, products] = await Promise.all([
    getSellers({ _id: { $in: sellersIds } }),
    getProducts({ _id: { $in: productsIds } }),
  ]);

  const [
    orderStatistics,
    topSellers,
    topSellingProducts,
    budgetToOrderConversionRate,
  ] = await Promise.all([
    getOrderStatistics(orders),
    getTopSellers(orders, sellers),
    getTopSellingProducts(orders, products),
    calculateBudgetToOrderConversionRate(orders.length, { beginDate, endDate }),
  ]);

  return {
    ...documentsCountByEnt,
    ...orderStatistics,
    newClientsCount,
    topSellers,
    topSellingProducts,
    budgetToOrderConversionRate,
    totalSalesByMonth,
  };
}
