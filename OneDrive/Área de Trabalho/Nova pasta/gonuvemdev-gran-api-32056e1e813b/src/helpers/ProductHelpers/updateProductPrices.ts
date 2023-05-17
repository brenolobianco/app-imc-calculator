import { Types } from 'mongoose';

import { ProductDocument } from '../../interfaces';
import {
  bulkWriteProducts,
  fetchAllProducts,
} from '../../services/ProductServices';
import { MyObject, UpdateProductPricesInput } from '../../types';

function calculatePriceChange({
  price,
  percentageChangeType,
  value,
}: {
  price: number;
  percentageChangeType: UpdateProductPricesInput['percentageChangeType'];
  value: UpdateProductPricesInput['value'];
}) {
  const absolutePriceChange = Math.round((price * value) / (100 * 100));

  return percentageChangeType === 'decrease'
    ? -1 * absolutePriceChange
    : absolutePriceChange;
}

function createPricesPerFinishesUpdateData(
  pricesPerFinishes: ProductDocument['pricesPerFinishes'],
  { percentageChangeType, value }: UpdateProductPricesInput,
) {
  if (!(pricesPerFinishes && pricesPerFinishes.length > 0)) return {};

  const newPricesPerFinishes = pricesPerFinishes.map(({ price, finish }) => {
    const priceChange = calculatePriceChange({
      price,
      percentageChangeType,
      value,
    });

    const newPrice = price + priceChange;

    return { price: newPrice, finish };
  });

  return { pricesPerFinishes: newPricesPerFinishes };
}

function createPriceUpdateData(
  price: ProductDocument['price'],
  { percentageChangeType, value }: UpdateProductPricesInput,
) {
  if (!(price && price > 0)) return {};

  const priceChange = calculatePriceChange({
    price,
    percentageChangeType,
    value,
  });

  const newPrice = price + priceChange;

  return { price: newPrice };
}

function createProductPricesUpdateWrites(
  products: ProductDocument[],
  input: UpdateProductPricesInput,
) {
  return products.map(({ _id, price, pricesPerFinishes }) => {
    const priceUpdateData = createPriceUpdateData(price, input);

    const pricesPerFinishesUpdateData = createPricesPerFinishesUpdateData(
      pricesPerFinishes,
      input,
    );

    return {
      updateOne: {
        filter: { _id: Types.ObjectId(_id) },
        update: { ...priceUpdateData, ...pricesPerFinishesUpdateData },
      },
    };
  });
}

export async function updateProductPrices(
  input: UpdateProductPricesInput,
): Promise<MyObject> {
  const products = await fetchAllProducts({
    projection: 'price pricesPerFinishes',
  });

  const writes = createProductPricesUpdateWrites(products, input);

  const result = await bulkWriteProducts(writes);
  // console.log(result);

  return {};
}
