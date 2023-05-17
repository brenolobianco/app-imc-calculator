import mongoose, { SchemaDefinition } from 'mongoose';

import { EventDocument, EventInterface } from '../interfaces';
import { MongooseDefinition } from '../types';

const definition: MongooseDefinition<EventInterface> = {
  title: {
    type: String,
    required: true,
  },
  beginDate: {
    type: Date,
    required: true,
  },
  endDate: Date,
  duration: {
    type: Number,
    validate: Number.isInteger,
  },
  isPending: {
    type: Boolean,
    default: false,
  },
  sourceEvent: {
    type: mongoose.Types.ObjectId,
    ref: 'Event',
  },
  order: {
    type: mongoose.Types.ObjectId,
    ref: 'Order',
  },
  client: {
    type: mongoose.Types.ObjectId,
    ref: 'Client',
  },
  employees: [
    {
      type: mongoose.Types.ObjectId,
      ref: 'Employee',
    },
  ],
  color: String,
};

const EventSchema = new mongoose.Schema(definition as SchemaDefinition, {
  timestamps: true,
});

const Event = mongoose.model<EventDocument>('Event', EventSchema);

export default Event;
