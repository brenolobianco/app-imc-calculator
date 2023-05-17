import { ProductPricePerFinish } from '../../interfaces';
import {
  CreateProductInput,
  UpdateProductInput,
  UpdateProductPricesInput,
} from '../../types';
import { createArrayInput } from '../gqlTestHelper';

export function createInputCreateProduct(input: CreateProductInput): string {
  const pricesPerFinishes = createArrayInput(
    input.pricesPerFinishes as ProductPricePerFinish[],
    ({ price, finish }: ProductPricePerFinish) => {
      return `{
        price: ${price},
        finish: "${finish}"
      }`;
    },
  );

  return `{
    name: "${input.name}",
    isActivated: ${input.isActivated},
    cost: ${input.cost},
    type: ${input.type},
    price: ${input.price},
    pricesPerFinishes: ${pricesPerFinishes}
  }`;
}

export function createInputUpdateProduct(
  input: Required<UpdateProductInput>,
): string {
  return createInputCreateProduct(input);
}

export function createInputUpdateProductPrices(
  input: Required<UpdateProductPricesInput>,
): string {
  return `{
    percentageChangeType: "${input.percentageChangeType}",
    value: ${input.value}
  }`;
}
