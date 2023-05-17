import { ID } from '../types';

export interface FetchParams {
  conditions?: any;
  projection?: string;
  sort?: string;
  lean?: boolean;
}

export interface UpdateParams {
  conditions: any;
  updateData: any;
}

export interface BaseListResult<T> {
  objects: Array<T>;
  total: number;
  pages: number;
}

export interface ListPaginatedParams {
  conditions?: any;
  projection?: string;
  sort?: string;
  page?: number;
  perPage?: number;
}

export type FilterTypes =
  | 'id'
  | 'boolean'
  | 'dateInterval'
  | 'string'
  | 'list'
  | 'number';

export interface DateInterval {
  beginDate: Date;
  endDate: Date;
}

export interface FieldFilterObject {
  type: FilterTypes;
  name: string;
  value: string | boolean | Date | DateInterval | Array<unknown> | number | ID;
}

export interface IdFilterObject extends FieldFilterObject {
  value: ID;
}

export interface BooleanFilterObject extends FieldFilterObject {
  value: boolean;
}

export interface DateIntervalFilterObject extends FieldFilterObject {
  value: DateInterval;
}

export interface StringFilterObject extends FieldFilterObject {
  value: string;
}

export interface ArrayFilterObject extends FieldFilterObject {
  value: Array<unknown>;
}

export interface NumberFilterObject extends FieldFilterObject {
  value: number;
}

export interface Timestamps {
  readonly createdAt: Date;
  readonly updatedAt: Date;
}

/** Endereço */
export interface Address {
  /** Rua/Logradouro */
  street?: string;
  /** Número */
  number?: string;
  /** Bairro */
  district?: string;
  /** Cidade */
  city?: string;
  /** Estado */
  state?: string;
  /** CEP */
  postalCode?: string;
  /** Complemento */
  complement?: string;
}
