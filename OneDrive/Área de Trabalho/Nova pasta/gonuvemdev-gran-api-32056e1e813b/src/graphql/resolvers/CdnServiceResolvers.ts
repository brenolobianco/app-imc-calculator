import { wrapGqlAsyncFunc } from '../../middlewares/errorHandling/errorHandlingHelpers';
import {
  uploadMultipleImagesUsingApolloStream,
  uploadOneImageUsingApolloStream,
} from '../../services/cdn';
import { isGqlAuthenticated } from '../../middlewares/authentication/authenticationHelper';
import { MyObject } from '../../types';

async function uploadOneImage(_parent: unknown, args: any): Promise<MyObject> {
  const { file, options } = args;

  return uploadOneImageUsingApolloStream(file, options);
}

async function uploadImages(_parent: unknown, args: any): Promise<MyObject> {
  const { params } = args;

  return uploadMultipleImagesUsingApolloStream(params);
}

export const Mutation = {
  uploadOneImage: wrapGqlAsyncFunc(isGqlAuthenticated(uploadOneImage)),
  uploadImages: wrapGqlAsyncFunc(isGqlAuthenticated(uploadImages)),
};
