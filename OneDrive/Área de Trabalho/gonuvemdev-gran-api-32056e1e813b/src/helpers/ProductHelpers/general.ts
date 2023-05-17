import { ProductDoc, FinishDoc } from '../../interfaces';
import { checkIfFinishesExists } from '../../services/FinishServices';
import { CreateProductInput, UpdateProductInput } from '../../types';

export async function checkProductsReferences({
  pricesPerFinishes,
}: CreateProductInput | UpdateProductInput): Promise<void> {
  if (pricesPerFinishes && pricesPerFinishes.length > 0) {
    await checkIfFinishesExists(pricesPerFinishes.map(({ finish }) => finish));
  }
}

type CalculateProductPricePerFinishParams = {
  productCost: ProductDoc['cost'];
  finishValue: FinishDoc['value'];
};

export function calculateProductPricePerFinish({
  productCost,
  finishValue,
}: CalculateProductPricePerFinishParams): number {
  const profitMargin = 1.05;

  const expensiveProductThreshold = 29900;

  const expensiveProductDiscount = 0.3;

  const price = Math.round((productCost * finishValue * profitMargin) / 100);

  const discount =
    productCost > expensiveProductThreshold
      ? Math.round(price * expensiveProductDiscount)
      : 0;

  return price - discount;
}
