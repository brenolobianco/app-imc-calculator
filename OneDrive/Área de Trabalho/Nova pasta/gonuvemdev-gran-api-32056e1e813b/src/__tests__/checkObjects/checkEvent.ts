import {
  EventInterface,
  OrderInterface,
  ClientInterface,
  EmployeeInterface,
} from '../../interfaces';
import { checkClient } from './checkClient';
import { checkEmployee } from './checkEmployee';
import { checkOrder } from './checkOrder';
import { getISODateString } from './general';

// eslint-disable-next-line max-lines-per-function
export const checkEvent = (
  expected: Required<EventInterface>,
  received: EventInterface,
): void => {
  type omitKeys =
    | 'beginDate'
    | 'endDate'
    | 'sourceEvent'
    | 'order'
    | 'client'
    | 'employees';

  expect(received).toMatchObject<Omit<Required<EventInterface>, omitKeys>>({
    title: expected.title,
    duration: expected.duration,
    isPending: expected.isPending,
    color: expected.color,
  });

  expect(received.beginDate).toBe(getISODateString(expected.beginDate));

  expect(received.endDate).toBe(getISODateString(expected.endDate));

  if (received.sourceEvent) {
    expect(received.sourceEvent).toMatchObject({
      _id: expected.sourceEvent._id.toString(),
      title: expected.sourceEvent.title,
    });
  }

  checkOrder(
    expected.order as Required<OrderInterface>,
    received.order as OrderInterface,
  );

  checkClient(
    expected.client as Required<ClientInterface>,
    received.client as ClientInterface,
  );

  // eslint-disable-next-line no-unused-expressions
  (received.employees as EmployeeInterface[]).forEach((employee, i) => {
    if (expected.employees) {
      checkEmployee(
        expected.employees[i] as Required<EmployeeInterface>,
        employee as EmployeeInterface,
      );
    }
  });
};
