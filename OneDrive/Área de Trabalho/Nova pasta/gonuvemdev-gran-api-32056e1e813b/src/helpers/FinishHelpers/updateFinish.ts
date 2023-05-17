import { Types } from 'mongoose';
import {
  checkFinishConflicts,
  fetchOneFinish,
  updateOneFinish,
} from '../../services/FinishServices';
import { UpdateFinishInput } from '../../types';
import { FinishDoc, ProductDocument } from '../../interfaces';
import {
  fetchAllProducts,
  bulkWriteProducts,
} from '../../services/ProductServices';
import { calculateProductPricePerFinish } from '../ProductHelpers/general';

function createWriteUpdateOneProduct(finish: FinishDoc) {
  return (product: ProductDocument) => {
    const price = calculateProductPricePerFinish({
      productCost: product.cost,
      finishValue: finish.value,
    });

    return {
      updateOne: {
        filter: {
          _id: Types.ObjectId(product._id),
          'pricesPerFinishes.finish': Types.ObjectId(finish._id.toString()),
        },
        update: {
          'pricesPerFinishes.$.price': price,
        },
      },
    };
  };
}

async function updatePricePerFinishForAllProducts(finish: FinishDoc) {
  const products = await fetchAllProducts({
    projection: 'cost pricesPerFinishes',
  });

  const writes = products.map(createWriteUpdateOneProduct(finish));

  await bulkWriteProducts(writes);
}

type UpdateFinishParams = {
  id: string;
  input: UpdateFinishInput;
};

export async function updateFinish({
  id,
  input,
}: UpdateFinishParams): Promise<{ finish: FinishDoc }> {
  const finish = await fetchOneFinish({ conditions: { _id: id } });

  if (input.code) await checkFinishConflicts(input, finish._id);

  const finishUpdated = await updateOneFinish({
    conditions: { _id: finish._id },
    updateData: input,
  });

  const isValueChanging = finish.value !== finishUpdated.value;

  if (isValueChanging) await updatePricePerFinishForAllProducts(finishUpdated);

  return { finish: finishUpdated };
}
