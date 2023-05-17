import { userFieldsQuery } from './general';

export const adminFieldsQuery = `{
  _id
  user ${userFieldsQuery}
  employee {
    _id
    name
    occupation
    createdAt
    updatedAt
  }
  createdAt
  updatedAt
}`;
