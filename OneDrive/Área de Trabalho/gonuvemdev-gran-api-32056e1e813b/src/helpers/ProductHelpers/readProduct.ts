import { fetchOneProduct } from '../../services/ProductServices';
import { ProductDoc } from '../../interfaces';

export async function readProduct({
  id,
}: {
  id: string;
}): Promise<{ product: ProductDoc }> {
  const product = await fetchOneProduct({ conditions: { _id: id } });

  return { product };
}
