import { customAlphabet } from 'nanoid/async';

import { ID } from '../types';

export function isNotEmptyArray<T>(array: T[]): boolean {
  return array && array.length > 0;
}

export function isEmptyArray<T>(array: T[]): boolean {
  return !isNotEmptyArray(array);
}

/**
 * Gera, de forma assíncrona, uma string aleatória de acordo com o alfabeto
 * e o tamanho informado.
 * @param {String} alphabet Alfabeto para geração da string.
 * Ex.: '1234567890abcdef'
 * @param {Number} len Tamanho da string a ser gerada. Ex.: 10.
 */
export const generateRandomString = (
  alphabet: string,
  len: number,
): Promise<string> => {
  const nanoid = customAlphabet(alphabet, len);

  return nanoid();
};

/**
 * Obtém um campo de um objeto.
 * @param o Objeto cujo campo será obtido
 * @param propertyName Nome do campo a ser obtido
 */
export function getProperty<T, K extends keyof T>(propertyName: K) {
  return (o: T): T[K] => {
    return o[propertyName]; // o[propertyName] is of type T[K]
  };
}

/**
 * Obtém os campos de um objeto.
 * @param o Objeto cujos campos serão obtidos
 * @param propertyNames Nomes dos campos
 */
export function pluck<T, K extends keyof T>(propertyNames: K[]) {
  return (o: T): T[K][] => {
    return propertyNames.map(n => o[n]);
  };
}

export function isIDEqual(id1: ID, id2: ID): boolean {
  return id1.toString() === id2.toString();
}

export const groupBy = <T, K extends keyof any>(
  list: T[],
  getKey: (item: T) => K,
): Record<K, T[]> =>
  list.reduce((previous, currentItem) => {
    const group = getKey(currentItem);
    // eslint-disable-next-line no-param-reassign
    if (!previous[group]) previous[group] = [];
    previous[group].push(currentItem);
    return previous;
  }, {} as Record<K, T[]>);

function has<T, K extends keyof T>(o: T, propertyName: K): boolean {
  return Object.prototype.hasOwnProperty.call(o, propertyName);
}

export function pick<T, K extends keyof T>(
  o: T,
  propertyNames: K[],
): Pick<T, K> {
  const result = {} as Pick<T, K>;

  propertyNames.forEach(key => {
    if (has(o, key)) result[key] = o[key];
  });

  return result;
}

export function omit<T, K extends keyof T>(
  o: T,
  propertyNames: K[],
): Omit<T, K> {
  const result = {};

  Object.keys(o).forEach(key => {
    if (!propertyNames.find(prop => prop === key)) {
      Object.assign(result, { [key]: o[key as keyof T] });
    }
  });

  return result as Omit<T, K>;
}
