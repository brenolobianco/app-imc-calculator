import createFinishTest from './createFinishTest';
import updateFinishTest from './updateFinishTest';
import deleteFinishTest from './deleteFinishTest';
import listFinishesTest from './listFinishesTest';
import readFinishTest from './readFinishTest';

describe('Test Finish Resolvers', () => {
  describe('Test createFinish', createFinishTest);

  describe('Test updateFinish', updateFinishTest);

  describe('Test deleteFinish', deleteFinishTest);

  describe('Test listFinishes', listFinishesTest);

  describe('Test readFinish', readFinishTest);
});
