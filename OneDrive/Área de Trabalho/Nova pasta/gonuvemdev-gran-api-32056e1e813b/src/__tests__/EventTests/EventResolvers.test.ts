import createEventTest from './createEventTest';
import updateEventTest from './updateEventTest';
import deleteEventTest from './deleteEventTest';
import listEventsTest from './listEventsTest';
import readEventTest from './readEventTest';

describe('Test Event Resolvers', () => {
  describe('Test createEvent', createEventTest);

  describe('Test updateEvent', updateEventTest);

  describe('Test deleteEvent', deleteEventTest);

  describe('Test listEvents', listEventsTest);

  describe('Test readEvent', readEventTest);
});
