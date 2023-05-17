import { wrapGqlAsyncFunc } from '../../middlewares/errorHandling/errorHandlingHelpers';
import validateGqlRequest from '../../middlewares/validation';
import isGqlAuthenticated from '../../middlewares/authentication';
import isGqlAuthorized from '../../middlewares/authorization';
import * as GeneralSearchHelpers from '../../helpers/GeneralSearchHelpers';
import {
  MyContext,
  GeneralSearchParams,
  GeneralSearchResponse,
} from '../../types';

function generalSearch(
  _parent: unknown,
  _args: unknown,
  context: MyContext<GeneralSearchParams>,
): Promise<GeneralSearchResponse> {
  return GeneralSearchHelpers.generalSearch(context.validData);
}

export const Query = {
  generalSearch: wrapGqlAsyncFunc(
    isGqlAuthenticated(isGqlAuthorized(validateGqlRequest(generalSearch))),
  ),
};
