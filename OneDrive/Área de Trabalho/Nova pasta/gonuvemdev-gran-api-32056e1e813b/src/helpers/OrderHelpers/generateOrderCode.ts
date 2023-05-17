import Order from '../../models/Order';
import { isEmptyArray } from '../../utils/general';

export async function generateOrderCode(): Promise<string> {
  const orders = await Order.find({}, 'code')
    .sort('-code')
    .collation({ locale: 'pt', numericOrdering: true })
    .limit(1)
    .lean();

  if (isEmptyArray(orders)) return '1';

  const highestCode = orders[0].code;

  return String(parseInt(highestCode, 10) + 1);
}
