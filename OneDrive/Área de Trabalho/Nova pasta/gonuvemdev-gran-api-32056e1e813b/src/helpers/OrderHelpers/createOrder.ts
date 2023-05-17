import { OrderDocument, OrderEvent, UserDoc } from '../../interfaces';
import { fetchOneAdmin } from '../../services/AdminServices';
import { fetchOneClient } from '../../services/ClientServices';
import { fetchOneEmployee } from '../../services/EmployeeServices';
import { checkIfFinishesExists } from '../../services/FinishServices';
import { createOneOrder } from '../../services/OrderServices';
import { checkIfProductsExists } from '../../services/ProductServices';
import { CreateOrderInput, ID } from '../../types';
import { getProperty } from '../../utils/general';
import { generateOrderCode } from './generateOrderCode';

async function getSellerIdFromLoggedUser(user: UserDoc): Promise<ID> {
  const admin = await fetchOneAdmin({ conditions: { user: user._id } });

  return admin._id;
}

async function checkReferences({
  client,
  intermediator,
  items,
}: CreateOrderInput): Promise<void> {
  const fetchEmployeePromise = intermediator
    ? fetchOneEmployee({ conditions: { _id: intermediator } })
    : Promise.resolve(null);

  const productsIds = items.map(getProperty('product'));
  const finishesIds = items.map(getProperty('finish'));

  await Promise.all([
    fetchOneClient({ conditions: { _id: client } }),
    fetchEmployeePromise,
    checkIfProductsExists(productsIds),
    checkIfFinishesExists(finishesIds),
  ]);
}

function createInitialOrderEvent(input: CreateOrderInput): OrderEvent {
  return {
    date: new Date(Date.now()),
    status: input.status,
    description: 'Pedido criado com esse status',
  };
}

export async function createOrder(
  user: UserDoc,
  input: CreateOrderInput,
): Promise<{ order: OrderDocument }> {
  const [sellerId] = await Promise.all([
    getSellerIdFromLoggedUser(user),
    checkReferences(input),
  ]);

  const code = await generateOrderCode();

  const event = createInitialOrderEvent(input);

  const order = await createOneOrder({
    doc: { ...input, code, seller: sellerId, events: [event] },
  });

  return { order };
}
