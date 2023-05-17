import mongoose from 'mongoose';

import { AdminDocument, AdminInterface } from '../interfaces';
import { MongooseDefinition } from '../types';
import './User';
import './Employee';

const definition: MongooseDefinition<AdminInterface> = {
  user: {
    type: mongoose.Types.ObjectId,
    ref: 'User',
    required: true,
  },
  employee: {
    type: mongoose.Types.ObjectId,
    ref: 'Employee',
  },
};

const AdminSchema = new mongoose.Schema(definition, { timestamps: true });

const Admin = mongoose.model<AdminDocument>('Admin', AdminSchema);

export default Admin;
