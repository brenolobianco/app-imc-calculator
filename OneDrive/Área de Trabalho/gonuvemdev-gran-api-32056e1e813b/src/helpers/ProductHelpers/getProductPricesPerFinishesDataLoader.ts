import Dataloader from 'dataloader';

import {
  ProductDocument,
  ProductPricePerFinish,
  FinishDocument,
} from '../../interfaces';
import { PricesPerFinishesDataLoader, ID } from '../../types';
import { fetchAllFinishes } from '../../services/FinishServices';
import { isIDEqual } from '../../utils/general';

function getFinishesIdsFromProducts(
  products: readonly ProductDocument[],
): ID[] {
  return products.flatMap(({ pricesPerFinishes }) => {
    if (pricesPerFinishes && pricesPerFinishes.length > 0) {
      return pricesPerFinishes.map(({ finish }) => finish as ID);
    }

    return [];
  });
}

function populateFinishes(
  products: readonly ProductDocument[],
  finishes: FinishDocument[],
): ProductPricePerFinish[][] {
  const findFinishById = (id: ID): FinishDocument =>
    finishes.find(finish => isIDEqual(finish._id, id)) as FinishDocument;

  return products.map(({ pricesPerFinishes }) => {
    if (pricesPerFinishes && pricesPerFinishes.length > 0) {
      return pricesPerFinishes.map(({ price, finish: finishId }) => {
        const finish = findFinishById(finishId as ID);

        return { price, finish };
      });
    }

    return [];
  });
}

async function getProductPricesPerFinishes(
  products: readonly ProductDocument[],
): Promise<ProductPricePerFinish[][]> {
  const finishesIds = getFinishesIdsFromProducts(products);

  const finishes = await fetchAllFinishes({
    conditions: { _id: { $in: finishesIds } },
  });

  return populateFinishes(products, finishes);
}

export function getProductPricesPerFinishesDataLoader(): PricesPerFinishesDataLoader {
  return new Dataloader(getProductPricesPerFinishes);
}
