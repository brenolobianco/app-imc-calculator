import { Document } from 'mongoose';

import { Timestamps } from './general';
import { ID } from '../types';
import { ProductType } from '../enums/ProductType';
import { FinishDoc } from './FinishInterfaces';

/** Preço do Produto por Acabamento */
export interface ProductPricePerFinish {
  /** Preço em centavos */
  price: number;
  /** Acabamento associado */
  finish: FinishDoc | ID;
}

/** Produto */
export interface ProductInterface {
  /** Nome */
  name: string;
  /** Indica se o produto está ativo ou não */
  isActivated: boolean;
  /** Custo em centavos */
  cost: number;
  /** Tipo */
  type: ProductType;
  /** Preço em centavos */
  price?: number;
  /** Lista de Preço por Acabamento */
  pricesPerFinishes?: ProductPricePerFinish[];
}

// eslint-disable-next-line prettier/prettier
export interface ProductDocument extends ProductInterface, Document, Timestamps { }

export interface ProductDoc extends ProductInterface, Timestamps {
  _id: ID;
}
