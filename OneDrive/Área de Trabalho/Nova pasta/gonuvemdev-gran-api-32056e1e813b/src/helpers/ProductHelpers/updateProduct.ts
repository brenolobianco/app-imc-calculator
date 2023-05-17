import {
  fetchOneProduct,
  updateOneProduct,
} from '../../services/ProductServices';
import { UpdateProductInput } from '../../types';
import { ProductDoc } from '../../interfaces';
import { checkProductsReferences } from './general';

export async function updateProduct({
  id,
  input,
}: {
  id: string;
  input: UpdateProductInput;
}): Promise<{ product: ProductDoc }> {
  const product = await fetchOneProduct({ conditions: { _id: id } });

  await checkProductsReferences(input);

  const productUpdated = await updateOneProduct({
    conditions: { _id: product._id },
    updateData: input,
  });

  return { product: productUpdated };
}
