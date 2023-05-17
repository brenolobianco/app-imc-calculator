import createOrderTest from './createOrderTest';
import listOrdersTest from './listOrdersTest';
import readOrderTest from './readOrderTest';
import updateOrderTest from './updateOrderTest';
import deleteOrderTest from './deleteOrderTest';
import duplicateBudgetTest from './duplicateBudgetTest';

describe('Test Order Resolvers', () => {
  describe('Test createOrder', createOrderTest);

  describe('Test listOrders', listOrdersTest);

  describe('Test readOrder', readOrderTest);

  describe('Test updateOrder', updateOrderTest);

  describe('Test deleteOrder', deleteOrderTest);

  describe('Test duplicateBudget', duplicateBudgetTest);
});
