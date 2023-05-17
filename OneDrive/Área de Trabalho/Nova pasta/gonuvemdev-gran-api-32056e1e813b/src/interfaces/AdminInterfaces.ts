import { Document } from 'mongoose';

import { Timestamps } from './general';
import { UserDocument } from './UserInterfaces';
import { ID } from '../types';
import { EmployeeDoc } from './EmployeeInterfaces';

export interface AdminInterface {
  user: Partial<UserDocument> | ID;
  employee?: EmployeeDoc | ID;
}

// eslint-disable-next-line prettier/prettier
export interface AdminDocument extends AdminInterface, Document, Timestamps { }

export interface AdminDoc extends AdminInterface, Timestamps {
  _id: ID;
}
