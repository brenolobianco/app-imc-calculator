import mongoose, { SchemaDefinition } from 'mongoose';
import bcrypt from 'bcrypt';

import { UserDocument, UserInterface } from '../interfaces';
import { Role } from '../enums';
import { SALT_WORK_FACTOR } from '../utils/constants';
import { MongooseDefinition } from '../types';

const definition: MongooseDefinition<UserInterface> = {
  name: {
    type: String,
    required: true,
  },
  email: {
    type: String,
    required: true,
    unique: true,
  },
  password: {
    type: String,
    required: true,
  },
  roles: [
    {
      type: String,
      enum: Object.values(Role),
      required: true,
    },
  ],
  renewPasswordCode: {
    type: String,
    default: '',
  },
};

const UserSchema = new mongoose.Schema(definition as SchemaDefinition, {
  timestamps: true,
});

/**
 * Password hash middleware.
 */
UserSchema.pre('save', async function save(next) {
  const user = this as UserDocument;

  if (!user.isModified('password')) return next();

  try {
    const salt = await bcrypt.genSalt(SALT_WORK_FACTOR);

    user.password = await bcrypt.hash(user.password, salt);

    return next();
  } catch (err) {
    return next(err);
  }
});

const User = mongoose.model<UserDocument>('User', UserSchema);

export default User;
