import Dataloader from 'dataloader';

import { OrderDocument, ClientDocument } from '../../interfaces';
import { ClientOrdersDataLoader } from '../../types';
import { fetchAllOrders } from '../../services/OrderServices';
import { getProperty, groupBy } from '../../utils/general';

async function getClientOrders(
  clients: readonly ClientDocument[],
): Promise<OrderDocument[][]> {
  const clientsIds = clients.map(getProperty('_id'));

  const orders = await fetchAllOrders({
    conditions: { client: { $in: clientsIds } },
  })
    .sort('-code')
    .collation({ locale: 'pt', numericOrdering: true });

  const ordersGroupedByClient = groupBy(
    orders,
    order => order.client as string,
  );

  return clientsIds.map(clientId => ordersGroupedByClient[clientId] || []);
}

export function getClientOrdersDataLoader(): ClientOrdersDataLoader {
  return new Dataloader(getClientOrders);
}
