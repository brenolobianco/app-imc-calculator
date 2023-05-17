import { wrapGqlAsyncFunc } from '../../middlewares/errorHandling/errorHandlingHelpers';
import validateGqlRequest from '../../middlewares/validation';
import isGqlAuthenticated from '../../middlewares/authentication';
import isGqlAuthorized from '../../middlewares/authorization';
import * as FinishHelpers from '../../helpers/FinishHelpers';
import {
  MyContext,
  CreateFinishInput,
  UpdateFinishInput,
  ListFinishesParams,
  ListFinishesResponse,
  MyObject,
} from '../../types';
import { FinishDoc, FinishDocument } from '../../interfaces';

function createFinish(
  _parent: unknown,
  _args: unknown,
  context: MyContext<{ input: CreateFinishInput }>,
): Promise<{ finish: FinishDocument }> {
  return FinishHelpers.createFinish(context.validData.input);
}

function updateFinish(
  _parent: unknown,
  _args: unknown,
  context: MyContext<{ id: string; input: UpdateFinishInput }>,
): Promise<{ finish: FinishDoc }> {
  return FinishHelpers.updateFinish(context.validData);
}

function deleteFinish(
  _parent: unknown,
  _args: unknown,
  context: MyContext<{ id: string }>,
): Promise<MyObject> {
  return FinishHelpers.deleteFinish(context.validData);
}

function listFinishes(
  _parent: unknown,
  _args: unknown,
  context: MyContext<ListFinishesParams>,
): Promise<ListFinishesResponse> {
  return FinishHelpers.listFinishes(context.validData);
}

function readFinish(
  _parent: unknown,
  _args: unknown,
  context: MyContext<{ id: string }>,
): Promise<{ finish: FinishDoc }> {
  return FinishHelpers.readFinish(context.validData);
}

export const Query = {
  listFinishes: wrapGqlAsyncFunc(
    isGqlAuthenticated(isGqlAuthorized(validateGqlRequest(listFinishes))),
  ),
  readFinish: wrapGqlAsyncFunc(
    isGqlAuthenticated(isGqlAuthorized(validateGqlRequest(readFinish))),
  ),
};

export const Mutation = {
  createFinish: wrapGqlAsyncFunc(
    isGqlAuthenticated(isGqlAuthorized(validateGqlRequest(createFinish))),
  ),
  updateFinish: wrapGqlAsyncFunc(
    isGqlAuthenticated(isGqlAuthorized(validateGqlRequest(updateFinish))),
  ),
  deleteFinish: wrapGqlAsyncFunc(
    isGqlAuthenticated(isGqlAuthorized(validateGqlRequest(deleteFinish))),
  ),
};
