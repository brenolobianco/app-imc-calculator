import { ListParams, ListResponse } from './general';
import { AdminDocument, AdminInterface, UserInterface } from '../interfaces';

export type CreateAdminInput = Omit<AdminInterface, 'user'> &
  Omit<UserInterface, 'renewPasswordCode'>;

export type UpdateAdminInput = Omit<AdminInterface, 'user'> &
  Omit<UserInterface, 'renewPasswordCode' | 'password'>;

export type ListAdminsParams = ListParams;

export type ListAdminsResponse = ListResponse & { admins: AdminDocument[] };
