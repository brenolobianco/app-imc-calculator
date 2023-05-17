import {
  ProductInterface,
  ProductPricePerFinish,
  FinishInterface,
} from '../../interfaces';
import { checkFinish } from './checkFinish';

// eslint-disable-next-line max-lines-per-function
export function checkProduct(
  expected: Required<ProductInterface>,
  received: ProductInterface,
): void {
  expect(received).toMatchObject<
    Required<Omit<ProductInterface, 'pricesPerFinishes'>>
  >({
    name: expected.name,
    isActivated: expected.isActivated,
    cost: expected.cost,
    type: expected.type,
    price: expected.price,
  });

  if (expected.pricesPerFinishes || received.pricesPerFinishes) {
    const pricesPerFinishes = received.pricesPerFinishes as ProductPricePerFinish[];

    // eslint-disable-next-line no-unused-expressions
    expected.pricesPerFinishes?.forEach(({ price, finish }, i) => {
      expect(pricesPerFinishes[i].price).toBe(price);
      checkFinish(
        finish as Required<FinishInterface>,
        pricesPerFinishes[i].finish as FinishInterface,
      );
    });
  }
}
