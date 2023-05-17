import { finishFieldsQuery } from './finishFieldsQuery';

export const productFieldsQuery = `{
  _id
  name
  isActivated
  cost
  type
  price
  pricesPerFinishes {
    price
    finish ${finishFieldsQuery}
  }
  createdAt
  updatedAt
}`;
