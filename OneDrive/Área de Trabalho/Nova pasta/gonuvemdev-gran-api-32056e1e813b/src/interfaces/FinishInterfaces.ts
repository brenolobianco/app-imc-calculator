import { Document } from 'mongoose';

import { Timestamps } from './general';
import { ID } from '../types';

/** Acabamento */
export interface FinishInterface {
  /** Código único */
  code: string;
  /** Valor. Multiplicador da matéria prima. Fator de escala 100 */
  value: number;
  /** Desenho. Url da imagem */
  design?: string;
  /** Engrosso na profundidade em centímetros */
  thickeningInDepth: number;
  /** Engrosso no comprimento em centímetros */
  thickeningInLength: number;
}

// eslint-disable-next-line prettier/prettier
export interface FinishDocument extends FinishInterface, Document, Timestamps { }

export interface FinishDoc extends FinishInterface, Timestamps {
  _id: ID;
}
