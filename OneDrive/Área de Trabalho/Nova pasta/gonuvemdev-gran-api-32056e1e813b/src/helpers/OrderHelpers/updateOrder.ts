import { fetchOneOrder, updateOneOrder } from '../../services/OrderServices';
import { UpdateOrderInput } from '../../types';
import { OrderDoc, OrderInterface } from '../../interfaces';
import { ORDER_TYPE_CANNOT_BE_CHANGED_TO_BUDGET } from '../../middlewares/errorHandling/errors';
import { OrderStatus } from '../../enums';
import { checkIfFinishesExists } from '../../services/FinishServices';
import { checkIfProductsExists } from '../../services/ProductServices';
import { getProperty } from '../../utils/general';
import { fetchOneClient } from '../../services/ClientServices';
import { fetchOneEmployee } from '../../services/EmployeeServices';

function checkIfOrderTypeCanBeChanged(
  currentType: OrderInterface['type'],
  incomingType?: OrderInterface['type'],
) {
  if (incomingType === 'budget' && currentType === 'order') {
    throw ORDER_TYPE_CANNOT_BE_CHANGED_TO_BUDGET;
  }
}

function createNewEventIfStatusIsChanging(
  currentStatus: OrderStatus,
  incomingStatus?: OrderStatus,
) {
  if (!incomingStatus) return null;

  if (incomingStatus !== currentStatus) {
    return {
      status: incomingStatus,
      date: new Date(Date.now()),
      description: `Pedido atualizado com novo status`,
    };
  }

  return null;
}

// eslint-disable-next-line max-lines-per-function
async function checkReferences({
  client,
  intermediator,
  items,
}: UpdateOrderInput): Promise<void> {
  const fetchClientPromise = client
    ? fetchOneClient({ conditions: { _id: client } })
    : Promise.resolve(null);

  const fetchEmployeePromise = intermediator
    ? fetchOneEmployee({ conditions: { _id: intermediator } })
    : Promise.resolve(null);

  if (items) {
    const productsIds = items.map(getProperty('product'));
    const finishesIds = items.map(getProperty('finish'));
    await Promise.all([
      checkIfProductsExists(productsIds),
      checkIfFinishesExists(finishesIds),
    ]);
  }

  await Promise.all([fetchClientPromise, fetchEmployeePromise]);
}

// eslint-disable-next-line max-lines-per-function
export async function updateOrder({
  id,
  input,
}: {
  id: string;
  input: UpdateOrderInput;
}): Promise<{ order: OrderDoc }> {
  const order = await fetchOneOrder({ conditions: { _id: id } });

  await checkReferences(input);

  const event = createNewEventIfStatusIsChanging(order.status, input.status);

  const events = event ? [...order.events, event] : order.events;

  const orderUpdated = await updateOneOrder({
    conditions: { _id: order._id },
    updateData: { ...input, events },
  });

  return { order: orderUpdated };
}
