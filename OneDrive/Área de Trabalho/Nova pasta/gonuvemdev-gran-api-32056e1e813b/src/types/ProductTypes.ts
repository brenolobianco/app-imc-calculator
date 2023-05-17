import DataLoader from 'dataloader';

import { ID, ListParams, ListResponse } from './general';
import {
  ProductPricePerFinish,
  ProductInterface,
  ProductDocument,
} from '../interfaces';

/** Parâmetros do objeto Preço do Produto por Acabamento */
export type ProductPricePerFinishInput = {
  /** Preço em centavos. Mínimo 0 */
  price: ProductPricePerFinish['price'];
  /** Acabamento associado. Regex: /^[0-9a-fA-F]{24}$/ */
  finish: ID;
};

/** Parâmetros para cadastro de produto. Pelo menos um dos campos de preço deve ser enviado. */
export type CreateProductInput = {
  /** Nome. Mínimo: 1 caracter */
  name: ProductInterface['name'];
  /** Indica se o produto está ativo ou não. Default: true */
  isActivated: ProductInterface['isActivated'];
  /** Custo. Valor em centavos. Mínimo: 0 */
  cost: ProductInterface['cost'];
  /** Tipo */
  type: ProductInterface['type'];
  /** Preço em centavos. Mínimo: 0 */
  price?: number;
  /** Lista de Preço por Acabamento */
  pricesPerFinishes?: ProductPricePerFinishInput[];
};

/** Parâmetros para atualização de produto */
export type UpdateProductInput = {
  /** Nome. Mínimo: 1 caracter */
  name?: ProductInterface['name'];
  /** Indica se o produto está ativo ou não. */
  isActivated?: ProductInterface['isActivated'];
  /** Custo em centavos. Mínimo: 0 */
  cost?: ProductInterface['cost'];
  /** Tipo */
  type?: ProductInterface['type'];
  /** Preço em centavos. Mínimo: 0 */
  price?: number;
  /** Lista de Preço por Acabamento */
  pricesPerFinishes?: ProductPricePerFinishInput[];
};

/** Filtros de Produto */
export type ProductFilter = {
  /** Filtro de produto ativo */
  isActivated?: ProductInterface['isActivated'];
  /** Filtro de tipo */
  type?: ProductInterface['type'];
};

export type ListProductsParams = ListParams<ProductFilter>;

export type ListProductsResponse = ListResponse & {
  products: ProductDocument[];
};

export type PricesPerFinishesDataLoader = DataLoader<
  ProductDocument,
  ProductPricePerFinish[],
  ProductDocument[]
>;

/** Parâmetros para a atualização dos preços dos Produtos */
export type UpdateProductPricesInput = {
  /** Tipo de mudança percentual. Valores válidos: ['increase', 'decrease'] */
  percentageChangeType: 'increase' | 'decrease';
  /** Valor percentual. Mínimo: 0. Ex.: 7500 (75,00%) */
  value: number;
};
