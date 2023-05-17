import Dataloader from 'dataloader';

import {
  FinishDocument,
  OrderDocument,
  OrderItem,
  ProductDocument,
} from '../../interfaces';
import { fetchAllFinishes } from '../../services/FinishServices';
import { fetchAllProducts } from '../../services/ProductServices';
import { ID, OrderItemsDataLoader } from '../../types';
import { isEmptyArray, isIDEqual } from '../../utils/general';

function getProductsAndFinishesIdsFromOrders(
  orders: readonly OrderDocument[],
): { productsIds: ID[]; finishesIds: ID[] } {
  const initialValue = { productsIds: [] as ID[], finishesIds: [] as ID[] };

  return orders.reduce((prev, curr) => {
    const productsIds = curr.items.map(({ product }) => product as ID);
    const finishesIds = curr.items.map(({ finish }) => finish as ID);

    return {
      productsIds: [...prev.productsIds, ...productsIds],
      finishesIds: [...prev.finishesIds, ...finishesIds],
    };
  }, initialValue);
}

// eslint-disable-next-line max-lines-per-function
function populateProductsAndFinishes(
  orders: readonly OrderDocument[],
  products: ProductDocument[],
  finishes: FinishDocument[],
): OrderItem[][] {
  // eslint-disable-next-line max-lines-per-function
  function populateProductAndFinishFromItem(item: OrderItem): OrderItem {
    const product = products.find(({ _id }) =>
      isIDEqual(_id, item.product as ID),
    ) as ProductDocument;

    const finish = finishes.find(({ _id }) =>
      isIDEqual(_id, item.finish as ID),
    ) as FinishDocument;

    return {
      depth: item.depth,
      description: item.description,
      length: item.length,
      price: item.price,
      quantity: item.quantity,
      product,
      finish,
      discount: item.discount,
      addition: item.addition,
      discountPercentage: item.discountPercentage,
      additionPercentage: item.additionPercentage,
      m2: item.m2,
      unitPrice: item.unitPrice,
    };
  }

  return orders.map(({ items }) => {
    if (isEmptyArray(items)) return [];

    return items.map(populateProductAndFinishFromItem);
  });
}

async function getOrderItems(
  orders: readonly OrderDocument[],
): Promise<OrderItem[][]> {
  const { productsIds, finishesIds } = getProductsAndFinishesIdsFromOrders(
    orders,
  );

  const [products, finishes] = await Promise.all([
    fetchAllProducts({ conditions: { _id: { $in: productsIds } } }),
    fetchAllFinishes({ conditions: { _id: { $in: finishesIds } } }),
  ]);

  return populateProductsAndFinishes(orders, products, finishes);
}

export function getOrderItemsDataLoader(): OrderItemsDataLoader {
  return new Dataloader(getOrderItems);
}
