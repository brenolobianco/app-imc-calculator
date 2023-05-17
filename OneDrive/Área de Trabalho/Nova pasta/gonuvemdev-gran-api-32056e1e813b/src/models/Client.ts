import mongoose, { SchemaDefinition } from 'mongoose';

import { ClientDocument, ClientInterface } from '../interfaces';
import { MongooseDefinition } from '../types';
import { AddressSchema } from '../utils/mongoose';

const definition: MongooseDefinition<ClientInterface> = {
  name: String,
  address: AddressSchema,
  primaryPhone: {
    type: String,
    unique: true,
    required: true,
  },
  secondaryPhones: [String],
  email: String,
  type: {
    type: String,
    enum: ['PF', 'PJ'],
    required: true,
  },
  cpf: String,
  cnpj: String,
  rg: String,
  stateRegistration: String,
  adminWhoRegistered: {
    type: mongoose.Types.ObjectId,
    ref: 'Admin',
  },
};

const ClientSchema = new mongoose.Schema(definition as SchemaDefinition, {
  timestamps: true,
});

const Client = mongoose.model<ClientDocument>('Client', ClientSchema);

export default Client;
