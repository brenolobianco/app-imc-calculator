import { OrderDocument } from '../../interfaces';
import { createOneOrder, fetchOneOrder } from '../../services/OrderServices';
import { generateOrderCode } from './generateOrderCode';

export async function duplicateBudget({
  id,
}: {
  id: string;
}): Promise<{ order: OrderDocument }> {
  // eslint-disable-next-line @typescript-eslint/no-unused-vars
  const { _id, createdAt, updatedAt, ...budgetData } = await fetchOneOrder({
    conditions: { _id: id, type: 'budget' },
  });

  const code = await generateOrderCode();

  const duplicatedBudget = await createOneOrder({
    doc: { ...budgetData, code },
  });

  return { order: duplicatedBudget };
}
