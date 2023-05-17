import { wrapGqlAsyncFunc } from '../../middlewares/errorHandling/errorHandlingHelpers';
import validateGqlRequest from '../../middlewares/validation';
import isGqlAuthenticated from '../../middlewares/authentication';
import isGqlAuthorized from '../../middlewares/authorization';
import * as StatisticsServiceHelpers from '../../helpers/StatisticsServiceHelpers';
import {
  GetBusinessStatisticsParams,
  GetBusinessStatisticsResponse,
  GetReportDataParams,
  GetReportDataResponse,
  MyContext,
} from '../../types';

function getBusinessStatistics(
  _parent: unknown,
  _args: unknown,
  context: MyContext<GetBusinessStatisticsParams>,
): Promise<GetBusinessStatisticsResponse> {
  return StatisticsServiceHelpers.getBusinessStatistics(context.validData);
}

function getReportData(
  _parent: unknown,
  _args: unknown,
  context: MyContext<GetReportDataParams>,
): Promise<GetReportDataResponse> {
  return StatisticsServiceHelpers.getReportData(context.validData);
}

export const Query = {
  getBusinessStatistics: wrapGqlAsyncFunc(
    isGqlAuthenticated(
      isGqlAuthorized(validateGqlRequest(getBusinessStatistics)),
    ),
  ),
  getReportData: wrapGqlAsyncFunc(
    isGqlAuthenticated(isGqlAuthorized(validateGqlRequest(getReportData))),
  ),
};
