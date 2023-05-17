import { Document } from 'mongoose';

import { ID } from '../types';
import { Timestamps } from './general';
import { ClientDoc } from './ClientInterfaces';
import { EmployeeDoc } from './EmployeeInterfaces';
import { OrderDoc } from './OrderInterfaces';

/** Evento */
export interface EventInterface {
  /** Título  */
  title: string;
  /** Horário inicial */
  beginDate: Date;
  /** Horário final */
  endDate?: Date;
  /** Duração em minutos */
  duration?: number;
  /** Indica se o evento é uma pendência */
  isPending?: boolean;
  /** Evento pai que originou esse evento */
  sourceEvent?: any | ID;
  /** Pedido relacionado a esse evento */
  order?: OrderDoc | ID;
  /** Cliente relacionado a esse evento */
  client?: ClientDoc | ID;
  /** Funcionários relacionados a esse evento */
  employees?: EmployeeDoc[] | ID[];
  /** Cor. Default: '#f4652d' */
  color?: string;
}

// eslint-disable-next-line prettier/prettier
export interface EventDocument extends EventInterface, Document, Timestamps { }

export interface EventDoc extends EventInterface, Timestamps {
  _id: ID;
}
