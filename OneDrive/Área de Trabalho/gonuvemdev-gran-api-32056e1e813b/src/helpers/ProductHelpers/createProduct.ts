import { createOneProduct } from '../../services/ProductServices';
import { ProductDocument } from '../../interfaces';
import { CreateProductInput } from '../../types';
import { checkProductsReferences } from './general';

export async function createProduct(
  input: CreateProductInput,
): Promise<{ product: ProductDocument }> {
  await checkProductsReferences(input);

  const product = await createOneProduct({ doc: input });

  return { product };
}
