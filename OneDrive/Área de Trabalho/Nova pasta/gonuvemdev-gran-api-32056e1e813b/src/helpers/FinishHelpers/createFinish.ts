import { Types } from 'mongoose';
import {
  checkFinishConflicts,
  createOneFinish,
} from '../../services/FinishServices';
import { FinishDocument, ProductDocument } from '../../interfaces';
import { CreateFinishInput } from '../../types';
import {
  bulkWriteProducts,
  fetchAllProducts,
} from '../../services/ProductServices';
import { calculateProductPricePerFinish } from '../ProductHelpers/general';

function createWriteUpdateOneProduct(finish: FinishDocument) {
  return (product: ProductDocument) => {
    const price = calculateProductPricePerFinish({
      productCost: product.cost,
      finishValue: finish.value,
    });

    return {
      updateOne: {
        filter: { _id: Types.ObjectId(product._id) },
        update: {
          $push: {
            pricesPerFinishes: { finish: Types.ObjectId(finish._id), price },
          },
        },
      },
    };
  };
}

async function addNewPricePerFinishForAllProducts(finish: FinishDocument) {
  const products = await fetchAllProducts({
    projection: 'cost pricesPerFinishes',
  });

  const writes = products.map(createWriteUpdateOneProduct(finish));

  await bulkWriteProducts(writes);
}

export async function createFinish(
  input: CreateFinishInput,
): Promise<{ finish: FinishDocument }> {
  await checkFinishConflicts(input);

  const finish = await createOneFinish({ doc: input });

  await addNewPricePerFinishForAllProducts(finish);

  return { finish };
}
