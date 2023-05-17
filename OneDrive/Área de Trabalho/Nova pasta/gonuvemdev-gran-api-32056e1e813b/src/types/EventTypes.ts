import DataLoader from 'dataloader';

import { ID, ListParams, ListResponse } from './general';
import {
  EventInterface,
  EventDocument,
  DateInterval,
  EmployeeDocument,
} from '../interfaces';

/** Parâmetros para cadastro de Evento */
export type CreateEventInput = {
  /** Título . Mínimo: 1 caracter */
  title: EventInterface['title'];
  /** Horário inicial. Date em ISOString */
  beginDate: EventInterface['beginDate'];
  /** Horário final. Date em ISOString */
  endDate?: EventInterface['endDate'];
  /** Duração em minutos. Mínimo: 0 */
  duration?: EventInterface['duration'];
  /** Indica se o evento é uma pendência */
  isPending?: EventInterface['isPending'];
  /** Evento pai que originou esse evento. Regex: /^[0-9a-fA-F]{24}$/ */
  sourceEvent?: ID;
  /** Pedido relacionado a esse evento. Regex: /^[0-9a-fA-F]{24}$/ */
  order?: ID;
  /** Cliente relacionado a esse evento. Regex: /^[0-9a-fA-F]{24}$/ */
  client?: ID;
  /** Funcionários relacionados a esse evento. Mínimo: 1 elemento. Regex: /^[0-9a-fA-F]{24}$/ */
  employees?: ID[];
  /** Cor. Default: '#f4652d'. Regex: /^#[0-9a-fA-F]{6}$/ */
  color?: EventInterface['color'];
};

/** Parâmetros para atualização de Evento */
export type UpdateEventInput = {
  /** Título . Mínimo: 1 caracter */
  title?: EventInterface['title'];
  /** Horário inicial. Date em ISOString */
  beginDate?: EventInterface['beginDate'];
  /** Horário final. Date em ISOString */
  endDate?: EventInterface['endDate'];
  /** Duração em minutos. Mínimo: 0 */
  duration?: EventInterface['duration'];
  /** Indica se o evento é uma pendência */
  isPending?: EventInterface['isPending'];
  /** Evento pai que originou esse evento. Regex: /^[0-9a-fA-F]{24}$/ */
  sourceEvent?: ID;
  /** Pedido relacionado a esse evento. Regex: /^[0-9a-fA-F]{24}$/ */
  order?: ID;
  /** Cliente relacionado a esse evento. Regex: /^[0-9a-fA-F]{24}$/ */
  client?: ID;
  /** Funcionários relacionados a esse evento. Mínimo: 1 elemento. Regex: /^[0-9a-fA-F]{24}$/ */
  employees?: ID[];
  /** Cor. Regex: /^#[0-9a-fA-F]{6}$/ */
  color?: EventInterface['color'];
};

/** Filtros de Evento */
export type EventFilter = {
  /** Filtro de intervalo de data */
  dateInterval?: DateInterval;
  /** Filtro de pendência */
  isPending?: EventInterface['isPending'];
  /** Filtro de Pedido */
  order?: EventInterface['order'];
  /** Filtro de Cliente */
  client?: EventInterface['client'];
  /** Filtro de Funcionário */
  employee?: ID;
};

export type ListEventsParams = ListParams<EventFilter>;

export type ListEventsResponse = ListResponse & {
  events: EventDocument[];
};

export type EventEmployeesDataLoader = DataLoader<
  EventDocument,
  EmployeeDocument[],
  EventDocument[]
>;
