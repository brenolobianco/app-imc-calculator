/* eslint-disable no-case-declarations */
/* eslint-disable consistent-return */
/* eslint-disable max-lines-per-function */
import { ReportDataType } from '../../enums/ReportDataType';
import { GetReportDataParams, GetReportDataResponse } from '../../types';
import { getClientDebtBySellerReportData } from './getClientDebtBySellerReportData';
import { getClosingOfCommissionsReportData } from './getClosingOfCommissionsReportData';
import { getProductsForProductionReportData } from './getProductsForProductionReportData';
import { getSalesInThePeriodReportData } from './getSalesInThePeriodReportData';
import { getSalesMapReportData } from './getSalesMapReportData';

export async function getReportData(
  params: GetReportDataParams,
): Promise<GetReportDataResponse> {
  // eslint-disable-next-line default-case
  switch (params.reportDataType) {
    case ReportDataType.ClientDebt:
      const clientDebtBySellerReportData = await getClientDebtBySellerReportData(
        params,
      );
      return { clientDebtBySellerReportData };
    case ReportDataType.ClosingOfCommission:
      const closingOfCommissionsReportData = await getClosingOfCommissionsReportData(
        params,
      );
      return { closingOfCommissionsReportData };
    case ReportDataType.ProductsForProduction:
      const productsForProductionReportData = await getProductsForProductionReportData(
        params,
      );
      return { productsForProductionReportData };
    case ReportDataType.SalesInThePeriod:
      const salesInThePeriodReportData = await getSalesInThePeriodReportData(
        params,
      );
      return { salesInThePeriodReportData };
    case ReportDataType.SalesMap:
      const salesMapReportData = await getSalesMapReportData(params);
      return { salesMapReportData };
  }
}
