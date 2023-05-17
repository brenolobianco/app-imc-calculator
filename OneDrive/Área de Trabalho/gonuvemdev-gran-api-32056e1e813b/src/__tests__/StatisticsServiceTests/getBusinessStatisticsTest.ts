/* eslint-disable max-lines */
/* eslint-disable max-lines-per-function */
import app from '../../app';
import * as utils from '../utils';
import * as helpers from '../helpers';
import * as err from '../../middlewares/errorHandling/errors';
import { Role } from '../../enums';
import * as gqlFieldsQuery from '../gqlFieldsQuery';
import * as checkObjects from '../checkObjects';
import {
  OrderInterface,
  ProductDocument,
  ProductInterface,
} from '../../interfaces';
import {
  GetBusinessStatisticsParams,
  GetBusinessStatisticsResponse,
  SalesByMonth,
  TopSeller,
  TopSellingProduct,
} from '../../types';
import { ProductType } from '../../enums/ProductType';
import Factory from '../../factories';

const resolver = 'getBusinessStatistics';

let setupData: helpers.SetupTaskResult;

const createQuery = ({
  beginDate = new Date('2019-01-19T14:03:28.451Z'),
  endDate = new Date('2022-01-19T14:03:28.451Z'),
  graphBeginDate = new Date('2019-01-19T14:03:28.451Z'),
  graphEndDate = new Date('2022-01-19T14:03:28.451Z'),
}: Partial<GetBusinessStatisticsParams>): string => `
query {
  ${resolver}(
    beginDate: "${beginDate.toISOString()}",
    endDate: "${endDate.toISOString()}",
    graphBeginDate: "${graphBeginDate.toISOString()}",
    graphEndDate: "${graphEndDate.toISOString()}"
  ) {
    ${gqlFieldsQuery.getBusinessStatisticsFieldsQuery}
    error ${gqlFieldsQuery.errorFieldsQuery}
  }
}
`;

type Ents = { objects: ProductDocument[] };
const createEnts = async (): Promise<void> => {
  const fakeOrder = Factory.build<OrderInterface>('Order');

  const user1 = await helpers.createUser({ body: { name: 'Vendedor 2' } });
  const user2 = await helpers.createUser({ body: { name: 'Vendedor 1' } });
  const employee = await helpers.createEmployee({
    body: { name: 'Vendedor 1' },
  });
  const admin = await helpers.createAdmin({
    body: { employee: employee._id, user: user2._id },
  });
  const admin2 = await helpers.createAdmin({
    body: { user: user1._id },
  });
  const product = await helpers.createProduct({
    body: { name: 'Mármore', type: ProductType.RawMaterial },
  });
  const product2 = await helpers.createProduct({
    body: { name: 'Granito', type: ProductType.RawMaterial },
  });
  const finish = await helpers.createFinish({
    body: {
      thickeningInDepth: 7,
      thickeningInLength: 4,
    },
  });
  const finish2 = await helpers.createFinish({
    body: {
      thickeningInDepth: 5,
      thickeningInLength: 5,
    },
  });
  const order = await helpers.createOrder({
    body: {
      type: 'order',
      total: 33300,
      date: new Date('2021-01-19T14:03:28.451Z'),
      seller: admin._id,
      items: [
        {
          ...fakeOrder.items[0],
          product: product._id,
          finish: finish._id,
          depth: 3,
          length: 6,
          addition: 10000,
          discount: 7700,
          price: 30000,
          m2: 100,
        },
      ],
    },
  });
  const order2 = await helpers.createOrder({
    body: {
      type: 'order',
      total: 50000,
      date: new Date('2021-02-19T14:03:28.451Z'),
      seller: admin2._id,
      items: [
        {
          ...fakeOrder.items[0],
          product: product2._id,
          finish: finish2._id,
          depth: 2,
          length: 2,
          addition: 30000,
          discount: 10000,
          price: 30000,
          m2: 49,
        },
      ],
    },
  });
  const event = await helpers.createEvent({});
  const budget = await helpers.createOrder({
    body: { type: 'budget', seller: admin._id },
  });
  const client = await helpers.createClient({});
};

const baseRequest = utils.baseGqlRequest(app, createQuery);

const checkResponse = (
  expected: ProductDocument,
  received: ProductDocument,
): void => {
  checkObjects.checkProduct(expected as Required<ProductInterface>, received);
  expect(received).toMatchObject({
    _id: expected._id.toString(),
    createdAt: expected.createdAt.toISOString(),
    updatedAt: expected.updatedAt.toISOString(),
  });
};

// eslint-disable-next-line max-lines-per-function
export default (): void => {
  beforeAll(async () => {
    setupData = await helpers.setupTask();
  });

  utils.testIsGqlAuthenticated(app, resolver, createQuery({}));

  const { rolesAllowed, rolesNotAllowed } = helpers.splitRolesByPermission([
    Role.Dev,
    Role.Admin,
  ]);

  rolesNotAllowed.forEach(role => {
    test(`403 ${role} not allowed`, () => {
      return baseRequest({}, setupData[role].token).then(
        utils.expectGqlError(err.USER_NOT_ALLOWED, resolver),
      );
    });
  });

  rolesAllowed.forEach(role => {
    test(`Not 403 - ${role} allowed`, () => {
      return baseRequest({}, setupData[role].token).then(response => {
        expect(response.status).not.toBe(403);
      });
    });
  });

  test('200 Business Statistics - check documents count', async () => {
    await createEnts();
    return baseRequest({}, setupData.dev.token).then(response => {
      // utils.printForDocs(response.body);
      const data = response.body.data[resolver];
      expect(data).toMatchObject<Partial<GetBusinessStatisticsResponse>>({
        numberOfAdmins: 2,
        numberOfBudgets: 1,
        numberOfClients: 1,
        numberOfEmployees: 1,
        numberOfEvents: 1,
        numberOfFinishes: 2,
        numberOfOrders: 2,
        numberOfProducts: 2,
      });
    });
  });

  test('200 Business Statistics - check order statistics', async () => {
    return baseRequest({}, setupData.dev.token).then(response => {
      const data = response.body.data[resolver];
      expect(data).toMatchObject<Partial<GetBusinessStatisticsResponse>>({
        orderTotalsSum: 83300,
        orderCount: 2,
      });
    });
  });

  test('200 Business Statistics - check new clients count', async () => {
    return baseRequest({}, setupData.dev.token).then(response => {
      const data = response.body.data[resolver];
      expect(data).toMatchObject<Partial<GetBusinessStatisticsResponse>>({
        newClientsCount: 1,
      });
    });
  });

  test('200 Business Statistics - check top sellers', async () => {
    return baseRequest({}, setupData.dev.token).then(response => {
      const data = response.body.data[resolver];
      expect(data.topSellers[0]).toMatchObject<Partial<TopSeller>>({
        name: 'Vendedor 2',
        count: 1,
        total: 50000,
      });
      expect(data.topSellers[1]).toMatchObject<Partial<TopSeller>>({
        name: 'Vendedor 1',
        count: 1,
        total: 33300,
      });
    });
  });

  test('200 Business Statistics - check top selling products', async () => {
    return baseRequest({}, setupData.dev.token).then(response => {
      const data = response.body.data[resolver];
      expect(data.topSellingProducts[0]).toMatchObject<
        Partial<TopSellingProduct>
      >({
        name: 'Mármore',
        total: 32300,
        totalM2: 100,
      });
      expect(data.topSellingProducts[1]).toMatchObject<
        Partial<TopSellingProduct>
      >({
        name: 'Granito',
        total: 50000,
        totalM2: 49,
      });
    });
  });

  test('200 Business Statistics - check budget to order conversion rate', async () => {
    return baseRequest({}, setupData.dev.token).then(response => {
      const data = response.body.data[resolver];
      expect(data).toMatchObject<Partial<GetBusinessStatisticsResponse>>({
        budgetToOrderConversionRate: 0.5,
      });
    });
  });

  test('200 Business Statistics - check total sales by month', async () => {
    return baseRequest({}, setupData.dev.token).then(response => {
      const data = response.body.data[resolver];
      expect(data.totalSalesByMonth).toHaveLength(2);
      expect(data.totalSalesByMonth[0]).toMatchObject<Partial<SalesByMonth>>({
        year: 2021,
        month: 1,
        count: 1,
        total: 33300,
      });
      expect(data.totalSalesByMonth[1]).toMatchObject<Partial<SalesByMonth>>({
        year: 2021,
        month: 2,
        count: 1,
        total: 50000,
      });
    });
  });

  test('200 Business Statistics - check total sales by month with filter', async () => {
    return baseRequest(
      {
        graphBeginDate: new Date('2021-01-01T14:03:28.451Z'),
        graphEndDate: new Date('2021-02-01T14:03:28.451Z'),
      },
      setupData.dev.token,
    ).then(response => {
      const data = response.body.data[resolver];
      expect(data.totalSalesByMonth).toHaveLength(1);
      expect(data.totalSalesByMonth[0]).toMatchObject<Partial<SalesByMonth>>({
        year: 2021,
        month: 1,
        count: 1,
        total: 33300,
      });
    });
  });

  afterAll(async () => {
    await helpers.dropCollections([
      'Product',
      'User',
      'Admin',
      'Client',
      'Employee',
      'Finish',
      'Order',
    ]);
  });
};
