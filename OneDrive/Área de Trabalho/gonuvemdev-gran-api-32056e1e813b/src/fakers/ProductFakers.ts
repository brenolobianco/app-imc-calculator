import {
  fakeArray,
  fakeBoolean,
  fakeId,
  fakeRandomArrayElement,
  fakeRandomInt,
  fakeWord,
} from './fakersUtils';
import { ProductInterface, ProductPricePerFinish } from '../interfaces';
import { Fake } from '../types';
import { ProductType } from '../enums/ProductType';

function fakeProductPricePerFinish(): ProductPricePerFinish {
  return {
    price: fakeRandomInt({ min: 100, max: 80000 })(),
    finish: fakeId(),
  };
}

export const fakeProduct: Fake<ProductInterface> = {
  name: fakeWord,
  isActivated: fakeBoolean,
  cost: fakeRandomInt({ min: 100, max: 50000 }),
  type: fakeRandomArrayElement(Object.values(ProductType)),
  price: fakeRandomInt({ min: 100, max: 80000 }),
  pricesPerFinishes: () => fakeArray(fakeProductPricePerFinish, 6),
};
