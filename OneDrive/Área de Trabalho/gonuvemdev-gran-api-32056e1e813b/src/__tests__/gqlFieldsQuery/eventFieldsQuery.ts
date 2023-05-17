import { clientFieldsQuery } from './clientFieldsQuery';
import { employeeFieldsQuery } from './employeeFieldsQuery';
import { orderFieldsQuery } from './orderFieldsQuery';

export const eventFieldsQuery = `{
  _id
  title
  beginDate
  endDate
  duration
  isPending
  sourceEvent {
    _id
    title
    beginDate
  }
  order ${orderFieldsQuery}
  client ${clientFieldsQuery}
  employees ${employeeFieldsQuery}
  color
  createdAt
  updatedAt
}`;
