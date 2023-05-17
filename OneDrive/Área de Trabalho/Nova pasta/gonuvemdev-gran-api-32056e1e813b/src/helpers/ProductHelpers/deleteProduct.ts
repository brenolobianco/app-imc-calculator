import {
  fetchOneProduct,
  deleteOneProduct,
  checkProductInUse,
} from '../../services/ProductServices';
import { MyObject } from '../../types';

export async function deleteProduct({ id }: { id: string }): Promise<MyObject> {
  const product = await fetchOneProduct({ conditions: { _id: id } });

  await checkProductInUse({ id: product._id });

  await deleteOneProduct({ conditions: { _id: product._id } });

  return {};
}
