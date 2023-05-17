import { ListParams, ListResponse } from './general';
import { FinishDocument, FinishInterface } from '../interfaces';

/** Parâmetros para cadastro de acabamento */
export type CreateFinishInput = {
  /** Código único. Mínimo: 1 caracter  */
  code: FinishInterface['code'];
  /** Valor. Multiplicador da matéria prima. Fator de escala 100. Mínimo: 100 */
  value: FinishInterface['value'];
  /** Desenho. Url da imagem. Formato de url válida */
  design?: FinishInterface['design'];
  /** Engrosso na profundidade em centímetros. Mínimo: 0 */
  thickeningInDepth: FinishInterface['thickeningInDepth'];
  /** Engrosso no comprimento em centímetros. Mínimo: 0 */
  thickeningInLength: FinishInterface['thickeningInLength'];
};

export type UpdateFinishInput = {
  /** Código único. Mínimo: 1 caracter  */
  code?: FinishInterface['code'];
  /** Valor. Multiplicador da matéria prima. Fator de escala 100. Mínimo: 100 */
  value?: FinishInterface['value'];
  /** Desenho. Url da imagem. Formato de url válida */
  design?: FinishInterface['design'];
  /** Engrosso na profundidade em centímetros. Mínimo: 0 */
  thickeningInDepth?: FinishInterface['thickeningInDepth'];
  /** Engrosso no comprimento em centímetros. Mínimo: 0 */
  thickeningInLength?: FinishInterface['thickeningInLength'];
};

export type ListFinishesParams = ListParams;

export type ListFinishesResponse = ListResponse & {
  finishes: FinishDocument[];
};
