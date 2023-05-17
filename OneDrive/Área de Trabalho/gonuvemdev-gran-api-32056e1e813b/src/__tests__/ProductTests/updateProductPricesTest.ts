/* eslint-disable max-lines-per-function */
import app from '../../app';
import * as utils from '../utils';
import * as helpers from '../helpers';
import * as err from '../../middlewares/errorHandling/errors';
import { Role } from '../../enums';
import { ProductDocument } from '../../interfaces';
import * as gqlFieldsQuery from '../gqlFieldsQuery';
import * as gqlInputs from '../gqlInputs';
import { UpdateProductPricesInput } from '../../types';
import Product from '../../models/Product';

const resolver = 'updateProductPrices';

let setupData: helpers.SetupTaskResult;

const createInput = gqlInputs.createInputUpdateProductPrices;

const createQuery = ({
  input,
}: {
  input: UpdateProductPricesInput;
}): string => `
mutation {
  ${resolver}(input: ${createInput(input)}) {
    error ${gqlFieldsQuery.errorFieldsQuery}
  }
}`;

const baseRequest = utils.baseGqlRequest(app, createQuery);

const createFakeBody = (
  body: Partial<UpdateProductPricesInput> = {},
): Required<UpdateProductPricesInput> => {
  return {
    percentageChangeType: 'increase',
    value: 500,
    ...body,
  };
};

type Ents = { objects: ProductDocument[] };
const createEnts = async (): Promise<Ents> => {
  const [finish1, finish2, finish3] = await Promise.all([
    helpers.createFinish({}),
    helpers.createFinish({}),
    helpers.createFinish({}),
  ]);

  const o1 = await helpers.createProduct({
    body: {
      price: 100,
      pricesPerFinishes: [{ price: 200, finish: finish1._id }],
    },
  });

  const o2 = await helpers.createProduct({
    body: {
      price: undefined,
      pricesPerFinishes: [
        { price: 2000, finish: finish2._id },
        { price: 3000, finish: finish3._id },
      ],
    },
  });

  const o3 = await helpers.createProduct({
    body: {
      price: 10000,
      pricesPerFinishes: undefined,
    },
  });

  const objects = [o1, o2, o3];

  return { objects };
};

async function checkProductPrices(
  productId: string,
  price: number | undefined,
  prices: number[] | undefined,
) {
  const product = await Product.findById(productId);

  expect(product?.price).toBe(price);

  if (prices || product?.pricesPerFinishes) {
    // eslint-disable-next-line no-unused-expressions
    product?.pricesPerFinishes?.forEach((pricePerFinish, i) => {
      expect(prices && prices[i]).toBe(pricePerFinish.price);
    });
  }
}

// eslint-disable-next-line max-lines-per-function
export default (): void => {
  beforeAll(async () => {
    setupData = await helpers.setupTask();
  });

  const fakeBody = createFakeBody();
  utils.testIsGqlAuthenticated(app, resolver, createQuery({ input: fakeBody }));

  const { rolesAllowed, rolesNotAllowed } = helpers.splitRolesByPermission([
    Role.Dev,
    Role.Admin,
  ]);

  rolesNotAllowed.forEach(role => {
    test(`403 ${role} not allowed`, () => {
      return baseRequest({ input: fakeBody }, setupData[role].token).then(
        utils.expectGqlError(err.USER_NOT_ALLOWED, resolver),
      );
    });
  });

  rolesAllowed.forEach(role => {
    test(`Not 403 - ${role} allowed`, async () => {
      return baseRequest({ input: fakeBody }, setupData[role].token).then(
        response => {
          expect(response.status).not.toBe(403);
        },
      );
    });
  });

  let ents: Ents;
  test('200 Product prices updated - increase 10%', async () => {
    ents = await createEnts();

    const body = createFakeBody({
      percentageChangeType: 'increase',
      value: 1000,
    });

    return baseRequest({ input: body }, setupData.dev.token).then(
      async response => {
        // utils.printForDocs(response);
        const { error } = response.body.data[resolver];
        expect(error).toBe(null);

        await checkProductPrices(ents.objects[0]._id, 110, [220]);
        await checkProductPrices(ents.objects[1]._id, undefined, [2200, 3300]);
        await checkProductPrices(ents.objects[2]._id, 11000, undefined);
      },
    );
  });

  test('200 Product prices updated - decrease 10%', async () => {
    const body = createFakeBody({
      percentageChangeType: 'decrease',
      value: 1000,
    });

    return baseRequest({ input: body }, setupData.dev.token).then(
      async response => {
        // utils.printForDocs(response);
        const { error } = response.body.data[resolver];
        expect(error).toBe(null);

        await checkProductPrices(ents.objects[0]._id, 99, [198]);
        await checkProductPrices(ents.objects[1]._id, undefined, [1980, 2970]);
        await checkProductPrices(ents.objects[2]._id, 9900, undefined);
      },
    );
  });

  afterAll(async () => {
    await helpers.dropCollections(['User', 'Product', 'Finish']);
  });
};
