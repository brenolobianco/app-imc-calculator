/* eslint-disable max-lines */
/* eslint-disable max-lines-per-function */
import app from '../../app';
import * as utils from '../utils';
import * as helpers from '../helpers';
import * as err from '../../middlewares/errorHandling/errors';
import { Role } from '../../enums';
import * as gqlFieldsQuery from '../gqlFieldsQuery';
import { OrderInterface } from '../../interfaces';
import {
  ClientDebtBySellerOrder,
  ClosingOfCommissionBySellerOrder,
  GetReportDataParams,
  GetReportDataResponse,
  SalesByProductOrder,
  SalesBySellerOrder,
  SalesMapByIntermediatorOrder,
} from '../../types';
import Factory from '../../factories';
import { ReportDataType } from '../../enums/ReportDataType';
import {
  checkClientDebtBySeller,
  checkClosingOfCommissionBySeller,
  checkSalesByProduct,
  checkSalesBySeller,
  checkSalesMapByIntermediator,
} from '../checkObjects';

const resolver = 'getReportData';

let setupData: helpers.SetupTaskResult;

const createQuery = ({
  reportDataType = ReportDataType.ClientDebt,
}: Partial<GetReportDataParams>): string => `
query {
  ${resolver}(reportDataType: ${reportDataType}) {
    ${gqlFieldsQuery.getReportDataFieldsQuery}
    error ${gqlFieldsQuery.errorFieldsQuery}
  }
}
`;

const createEnts = async (): Promise<void> => {
  const fakeOrder = Factory.build<OrderInterface>('Order');

  const [sellerUser2, sellerUser1, sellerUser3] = await Promise.all([
    helpers.createUser({ body: { name: 'Vendedor 2' } }),
    helpers.createUser({ body: { name: 'Vendedor 1' } }),
    helpers.createUser({ body: { name: 'Vendedor 3' } }),
  ]);

  const [seller1, seller2, seller3] = await Promise.all([
    helpers.createAdmin({ body: { user: sellerUser1._id } }),
    helpers.createAdmin({ body: { user: sellerUser2._id } }),
    helpers.createAdmin({ body: { user: sellerUser3._id } }),
  ]);

  const [client1, client2] = await Promise.all([
    helpers.createClient({
      body: { name: 'Cliente 1', primaryPhone: '0123456789' },
    }),
    helpers.createClient({
      body: { name: 'Cliente 2', primaryPhone: '9876543210' },
    }),
  ]);

  const [intermediator2, intermediator1] = await Promise.all([
    helpers.createEmployee({ body: { name: 'Inter 2' } }),
    helpers.createEmployee({ body: { name: 'Inter 1' } }),
  ]);

  const [product3, product2, product1] = await Promise.all([
    helpers.createProduct({ body: { name: 'Produto 3' } }),
    helpers.createProduct({ body: { name: 'Produto 2' } }),
    helpers.createProduct({ body: { name: 'Produto 1' } }),
  ]);

  const [budget1, order1, order2, order3, order4] = await Promise.all([
    helpers.createOrder({
      body: { type: 'budget', seller: seller3._id, client: client1._id },
    }),
    helpers.createOrder({
      body: {
        type: 'order',
        seller: seller1._id,
        client: client1._id,
        intermediator: undefined,
        total: 30000,
        sellerCommission: 1000,
        expectedDeliveryDate: new Date(Date.now() - 1),
        items: [
          {
            ...fakeOrder.items[0],
            product: product1._id,
            m2: 300,
          },
          {
            ...fakeOrder.items[1],
            product: product2._id,
            m2: 200,
          },
          {
            ...fakeOrder.items[0],
            product: product1._id,
            m2: 700,
          },
        ],
        payment: {
          paid: false,
          installments: [
            {
              expiresAt: new Date(),
              number: 1,
              value: 15000,
              incomingDate: new Date(),
            },
            {
              expiresAt: new Date(),
              number: 2,
              value: 15000,
            },
          ],
        },
      },
    }),
    helpers.createOrder({
      body: {
        type: 'order',
        seller: seller2._id,
        client: client2._id,
        intermediator: undefined,
        sellerCommission: 500,
        expectedDeliveryDate: new Date(Date.now() + 1000 * 60 * 24 * 3),
        total: 25700,
        items: [
          {
            ...fakeOrder.items[0],
            product: product1._id,
            m2: 300,
          },
          {
            ...fakeOrder.items[1],
            product: product2._id,
            m2: 200,
          },
          {
            ...fakeOrder.items[1],
            product: product2._id,
            m2: 700,
          },
        ],
        payment: {
          paid: true,
          installments: [
            {
              expiresAt: new Date(),
              number: 1,
              value: 15000,
              incomingDate: new Date(),
            },
            {
              expiresAt: new Date(),
              number: 2,
              value: 10700,
              incomingDate: new Date(),
            },
          ],
        },
      },
    }),
    helpers.createOrder({
      body: {
        type: 'order',
        seller: seller1._id,
        client: client2._id,
        intermediator: intermediator1._id,
        total: 14400,
        sellerCommission: 1000,
        expectedDeliveryDate: new Date(Date.now() + 1000 * 60 * 24 * 3),
        items: [
          {
            ...fakeOrder.items[1],
            product: product2._id,
            m2: 300,
          },
          {
            ...fakeOrder.items[1],
            product: product2._id,
            m2: 200,
          },
          {
            ...fakeOrder.items[1],
            product: product2._id,
            m2: 700,
          },
        ],
        payment: {
          paid: false,
          installments: [
            {
              expiresAt: new Date(),
              number: 1,
              value: 7000,
              incomingDate: new Date(),
            },
            {
              expiresAt: new Date(),
              number: 2,
              value: 7000,
              incomingDate: new Date(),
            },
          ],
        },
      },
    }),
    helpers.createOrder({
      body: {
        type: 'order',
        seller: seller2._id,
        client: client1._id,
        sellerCommission: 500,
        intermediator: intermediator2._id,
        total: 14200,
        expectedDeliveryDate: new Date(Date.now() + 1000 * 60 * 24 * 3),
        items: [
          {
            ...fakeOrder.items[0],
            product: product1._id,
            m2: 300,
          },
          {
            ...fakeOrder.items[0],
            product: product1._id,
            m2: 200,
          },
          {
            ...fakeOrder.items[0],
            product: product1._id,
            m2: 700,
          },
        ],
        payment: {
          paid: false,
          installments: [
            {
              expiresAt: new Date(),
              number: 1,
              value: 14200,
            },
          ],
        },
      },
    }),
  ]);
};

const baseRequest = utils.baseGqlRequest(app, createQuery);

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

  test('200 Sales in the period report data', async () => {
    await createEnts();
    return baseRequest(
      { reportDataType: ReportDataType.SalesInThePeriod },
      setupData.dev.token,
    ).then(response => {
      // utils.printForDocs(response.body);
      const data = response.body.data[resolver];
      const { salesInThePeriodReportData } = data as GetReportDataResponse;

      expect(salesInThePeriodReportData).toHaveLength(2);
      if (salesInThePeriodReportData) {
        const seller1 = {
          sellerName: 'Vendedor 1',
          ordersCount: 2,
          ordersTotalSum: 44400,
        };
        checkSalesBySeller(seller1, salesInThePeriodReportData[0]);
        expect(salesInThePeriodReportData[0].orders).toEqual(
          expect.arrayContaining([
            expect.objectContaining<Partial<SalesBySellerOrder>>({
              clientName: 'Cliente 1',
            }),
          ]),
        );
        const seller2 = {
          sellerName: 'Vendedor 2',
          ordersCount: 2,
          ordersTotalSum: 39900,
        };
        checkSalesBySeller(seller2, salesInThePeriodReportData[1]);
      }
    });
  });

  test('200 Products for production report data', () => {
    return baseRequest(
      { reportDataType: ReportDataType.ProductsForProduction },
      setupData.dev.token,
    ).then(response => {
      // utils.printForDocs(response.body);
      const data = response.body.data[resolver];
      const { productsForProductionReportData } = data as GetReportDataResponse;

      expect(productsForProductionReportData).toHaveLength(2);
      if (productsForProductionReportData) {
        const product1 = {
          productName: 'Produto 1',
          ordersCount: 2,
          totalM2: 1500,
        };
        checkSalesByProduct(product1, productsForProductionReportData[0]);
        expect(productsForProductionReportData[0].orders).toEqual(
          expect.arrayContaining([
            expect.objectContaining<Partial<SalesByProductOrder>>({
              clientName: 'Cliente 1',
              m2: 1200,
            }),
          ]),
        );
        const product2 = {
          productName: 'Produto 2',
          ordersCount: 2,
          totalM2: 2100,
        };
        checkSalesByProduct(product2, productsForProductionReportData[1]);
        expect(productsForProductionReportData[1].orders).toEqual(
          expect.arrayContaining([
            expect.objectContaining<Partial<SalesByProductOrder>>({
              sellerName: 'Vendedor 1',
              m2: 1200,
            }),
          ]),
        );
      }
    });
  });

  test('200 Sales map report data', () => {
    return baseRequest(
      { reportDataType: ReportDataType.SalesMap },
      setupData.dev.token,
    ).then(response => {
      // utils.printForDocs(response.body);
      const data = response.body.data[resolver];
      const { salesMapReportData } = data as GetReportDataResponse;

      if (salesMapReportData) {
        const intermediator1 = { intermediatorName: 'Inter 1' };
        checkSalesMapByIntermediator(intermediator1, salesMapReportData[0]);
        expect(salesMapReportData[0].orders).toEqual(
          expect.arrayContaining([
            expect.objectContaining<Partial<SalesMapByIntermediatorOrder>>({
              sellerName: 'Vendedor 1',
              clientName: 'Cliente 2',
            }),
          ]),
        );
        const intermediator2 = { intermediatorName: 'Inter 2' };
        checkSalesMapByIntermediator(intermediator2, salesMapReportData[1]);
        expect(salesMapReportData[1].orders).toEqual(
          expect.arrayContaining([
            expect.objectContaining<Partial<SalesMapByIntermediatorOrder>>({
              sellerName: 'Vendedor 2',
              clientName: 'Cliente 1',
            }),
          ]),
        );
        const intermediator3 = {
          intermediatorName: 'Vendas sem intermediário',
        };
        checkSalesMapByIntermediator(intermediator3, salesMapReportData[2]);
        expect(salesMapReportData[2].orders).toHaveLength(2);
      }
    });
  });

  test('200 Client Debt report data', () => {
    return baseRequest(
      { reportDataType: ReportDataType.ClientDebt },
      setupData.dev.token,
    ).then(response => {
      // utils.printForDocs(response.body);
      const data = response.body.data[resolver];
      const { clientDebtBySellerReportData } = data as GetReportDataResponse;

      expect(clientDebtBySellerReportData).toHaveLength(2);
      if (clientDebtBySellerReportData) {
        const seller1 = {
          sellerName: 'Vendedor 1',
          ordersCount: 2,
          ordersTotalSum: 44400,
          ordersPaymentSum: 29000,
          ordersBalanceSum: 15400,
        };
        checkClientDebtBySeller(seller1, clientDebtBySellerReportData[0]);
        expect(clientDebtBySellerReportData[0].orders).toEqual(
          expect.arrayContaining([
            expect.objectContaining<Partial<ClientDebtBySellerOrder>>({
              clientName: 'Cliente 1',
              clientPhone: '0123456789',
            }),
          ]),
        );
        const seller2 = {
          sellerName: 'Vendedor 2',
          ordersCount: 2,
          ordersTotalSum: 39900,
          ordersPaymentSum: 25700,
          ordersBalanceSum: 14200,
        };
        checkClientDebtBySeller(seller2, clientDebtBySellerReportData[1]);
      }
    });
  });

  test('200 Closing of commissions report data', () => {
    return baseRequest(
      { reportDataType: ReportDataType.ClosingOfCommission },
      setupData.dev.token,
    ).then(response => {
      // utils.printForDocs(response.body);
      const data = response.body.data[resolver];
      const { closingOfCommissionsReportData } = data as GetReportDataResponse;

      expect(closingOfCommissionsReportData).toHaveLength(2);
      if (closingOfCommissionsReportData) {
        const seller1 = {
          sellerName: 'Vendedor 1',
          ordersCount: 2,
          ordersTotalSum: 44400,
          ordersCommissionSum: 4440,
        };
        checkClosingOfCommissionBySeller(
          seller1,
          closingOfCommissionsReportData[0],
        );
        expect(closingOfCommissionsReportData[0].orders).toEqual(
          expect.arrayContaining([
            expect.objectContaining<Partial<ClosingOfCommissionBySellerOrder>>({
              clientName: 'Cliente 1',
              sellerCommission: 3000,
            }),
          ]),
        );
        const seller2 = {
          sellerName: 'Vendedor 2',
          ordersCount: 2,
          ordersTotalSum: 39900,
          ordersCommissionSum: 1995,
        };
        checkClosingOfCommissionBySeller(
          seller2,
          closingOfCommissionsReportData[1],
        );
      }
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
