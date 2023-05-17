import {
  fakeArray,
  fakeBoolean,
  fakeFutureDate,
  fakeHexColor,
  fakeId,
  fakeRandomInt,
  fakeSentence,
} from './fakersUtils';
import { EventInterface } from '../interfaces';
import { Fake } from '../types';

export const fakeEvent: Fake<EventInterface> = {
  title: fakeSentence,
  beginDate: fakeFutureDate,
  endDate: fakeFutureDate,
  duration: fakeRandomInt({ min: 0, max: 240 }),
  isPending: fakeBoolean,
  sourceEvent: fakeId,
  order: fakeId,
  client: fakeId,
  employees: () => fakeArray(fakeId, 2),
  color: fakeHexColor,
};
