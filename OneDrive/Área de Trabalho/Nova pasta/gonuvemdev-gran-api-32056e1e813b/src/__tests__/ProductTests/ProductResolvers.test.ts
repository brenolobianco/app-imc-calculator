import createProductTest from './createProductTest';
import updateProductTest from './updateProductTest';
import deleteProductTest from './deleteProductTest';
import listProductsTest from './listProductsTest';
import readProductTest from './readProductTest';
import updateProductPricesTest from './updateProductPricesTest';

describe('Test Product Resolvers', () => {
  describe('Test createProduct', createProductTest);

  describe('Test updateProduct', updateProductTest);

  describe('Test deleteProduct', deleteProductTest);

  describe('Test listProducts', listProductsTest);

  describe('Test readProduct', readProductTest);

  describe('Test updateProductPrices', updateProductPricesTest);
});
