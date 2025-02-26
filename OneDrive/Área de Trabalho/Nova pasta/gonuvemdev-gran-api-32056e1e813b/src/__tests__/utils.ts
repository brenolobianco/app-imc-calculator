import { Express } from 'express';
import request, { Response } from 'supertest';
import { Boom } from '@hapi/boom';

import {
  INVALID_AUTH_HEADER,
  INVALID_TOKEN,
} from '../middlewares/errorHandling/errors';
import { MyObject } from '../types';

export const unregisteredToken =
  'eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.' +
  'eyJfaWQiOiI1YmY1ZDQ4NmVmYTJlOTAwMmY5MDg5ZWUiLCJqdGkiOiI1YmY1ZDQ4NmVmYTJlOTAwMmY5MDg5ZWUxMTU0MzAxMTAzOTY3NiIsImlhdCI6MTU0MzAxMTAzOTY3NiwiZGV2aWNlSWQiOiIxIn0.' +
  'USvOy3TC0WgWbGXX6j1o72q4g9HSS5LYb15YURwbzHg';

export const expectGqlError = (errorObject: Boom, resolver: string) => (
  response: Response,
): void => {
  expect(response.body.data[resolver].error).toMatchObject({
    statusCode: errorObject.output.payload.statusCode,
    internalCode: errorObject.data.internalCode,
    message: errorObject.output.payload.message,
  });
};

// eslint-disable-next-line max-lines-per-function
export const testIsGqlAuthenticated = (
  app: Express,
  resolver: string,
  query: string,
): void => {
  const unauthorizedTestCases = [
    { name: 'no Bearer', value: ['authorization', 'QualquerCoisa'] },
    { name: 'missing token', value: ['authorization', 'Bearer '] },
  ];

  test('401 Invalid auth header - no auth', () => {
    return request(app)
      .post('/graphql')
      .send({ query })
      .then(expectGqlError(INVALID_AUTH_HEADER, resolver));
  });

  unauthorizedTestCases.forEach(t => {
    test(`401 Invalid auth header - ${t.name}`, () => {
      return request(app)
        .post('/graphql')
        .send({ query })
        .set(t.value[0], t.value[1])
        .then(expectGqlError(INVALID_AUTH_HEADER, resolver));
    });
  });

  const forbiddenTestCases = [
    { name: 'without components', value: ['authorization', 'Bearer a'] },
    { name: 'wrong components', value: ['authorization', 'Bearer a.b.c'] },
    {
      name: 'unregistered token',
      value: ['authorization', `Bearer ${unregisteredToken}`],
    },
  ];

  forbiddenTestCases.forEach(t => {
    test(`403 Invalid token - ${t.name}`, () => {
      return request(app)
        .post('/graphql')
        .send({ query })
        .set(t.value[0], t.value[1])
        .then(expectGqlError(INVALID_TOKEN, resolver));
    });
  });
};

export const printForDocs = (object: unknown, name = ''): void => {
  // eslint-disable-next-line no-console
  console.log('>', name);
  // eslint-disable-next-line no-console
  console.log(JSON.stringify(object, null, 2));
};

export const baseGqlListResponseExpected = (
  collectionName: string,
  resolver: string,
) => (response: Response, total = 3, pages = 1): void => {
  const body = response.body.data[resolver];
  expect(body.total).toBe(total);
  expect(body.pages).toBe(pages);
  expect(body).toHaveProperty(collectionName);
};

export const sortByStringAsc = (a: string, b: string): number => {
  return a.localeCompare(b);
};

export const sortByStringDesc = (a: string, b: string): number => {
  return b.localeCompare(a);
};

export const sortByDateAsc = (a: Date, b: Date): number => {
  return new Date(a).getTime() - new Date(b).getTime();
};

export const sortByDateDesc = (a: Date, b: Date): number => {
  return new Date(b).getTime() - new Date(a).getTime();
};

export const sortByNumberAsc = (a: number, b: number): number => a - b;

export const sortByNumberDesc = (a: number, b: number): number => b - a;

export function deepCopy(obj: MyObject): { [key: string]: unknown } {
  return JSON.parse(JSON.stringify(obj));
}

export function removePropertyFromObj(
  property: string,
  obj: MyObject,
): MyObject {
  const copy = deepCopy(obj);
  delete copy[property];
  return copy;
}

export function replacePropertyFromObj(
  property: string,
  obj: MyObject,
  newValue: unknown,
): MyObject {
  const copy = deepCopy(obj);
  copy[property] = newValue;
  return copy;
}

export const baseGqlRequest = (
  app: Express,
  createQueryFunc: (p: any) => unknown,
) => (queryParams: MyObject, token = ''): request.Test => {
  return request(app)
    .post('/graphql')
    .send({ query: createQueryFunc(queryParams) })
    .set('authorization', `Bearer ${token}`);
};
