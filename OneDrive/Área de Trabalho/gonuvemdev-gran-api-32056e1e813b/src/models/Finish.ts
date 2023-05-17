import mongoose, { SchemaDefinition } from 'mongoose';

import { FinishDocument, FinishInterface } from '../interfaces';
import { MongooseDefinition } from '../types';

const definition: MongooseDefinition<FinishInterface> = {
  code: {
    type: String,
    unique: true,
    required: true,
  },
  value: {
    type: Number,
    required: true,
    validate: Number.isInteger,
  },
  design: String,
  thickeningInDepth: {
    type: Number,
    required: true,
    validate: Number.isInteger,
  },
  thickeningInLength: {
    type: Number,
    required: true,
    validate: Number.isInteger,
  },
};

const FinishSchema = new mongoose.Schema(definition as SchemaDefinition, {
  timestamps: true,
});

const Finish = mongoose.model<FinishDocument>('Finish', FinishSchema);

export default Finish;
