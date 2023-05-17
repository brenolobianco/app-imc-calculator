import Joi from 'joi';

import {
  createSchema,
  updateSchema,
  removeSchema,
  listSchema,
  readSchema,
  basicStringSchema,
  integerSchema,
  booleanSchema,
  stringEnumSchema,
  idSchema,
  arraySchema,
} from './baseSchemas';
import {
  JoiSchemaMap,
  CreateProductInput,
  UpdateProductInput,
  ProductFilter,
  UpdateProductPricesInput,
} from '../../../types';
import { ProductInterface, ProductPricePerFinish } from '../../../interfaces';
import { ProductType } from '../../../enums/ProductType';

const productPricePerFinishKeys: JoiSchemaMap<Required<
  ProductPricePerFinish
>> = {
  price: integerSchema.min(0).required(),
  finish: idSchema.required(),
};

export const ProductSchema: JoiSchemaMap<Required<ProductInterface>> = {
  name: basicStringSchema,
  isActivated: booleanSchema,
  cost: integerSchema.min(0),
  type: stringEnumSchema(ProductType),
  price: integerSchema.min(0),
  pricesPerFinishes: arraySchema(Joi.object(productPricePerFinishKeys)),
};

const createKeys: JoiSchemaMap<Required<CreateProductInput>> = {
  name: ProductSchema.name.required(),
  isActivated: ProductSchema.isActivated.required().default(true),
  cost: ProductSchema.cost.required(),
  type: ProductSchema.type.required(),
  price: ProductSchema.price.optional(),
  pricesPerFinishes: ProductSchema.pricesPerFinishes.optional(),
};

const create = createSchema(
  Joi.object().keys(createKeys).or('price', 'pricesPerFinishes'),
);

const updateKeys: JoiSchemaMap<Required<UpdateProductInput>> = {
  name: ProductSchema.name.optional(),
  isActivated: ProductSchema.isActivated.optional(),
  cost: ProductSchema.cost.optional(),
  type: ProductSchema.type.optional(),
  price: ProductSchema.price.optional(),
  pricesPerFinishes: ProductSchema.pricesPerFinishes.optional(),
};
const update = updateSchema(
  Joi.object()
    .keys(updateKeys)
    .or('name', 'isActivated', 'cost', 'type', 'price', 'pricesPerFinishes'),
);

const remove = removeSchema;

const sortFields = [
  '-name',
  'name',
  '-createdAt',
  'createdAt',
  'cost',
  '-cost',
];
const defaultField = 'name';
const filters: JoiSchemaMap<Required<ProductFilter>> = {
  isActivated: ProductSchema.isActivated.optional(),
  type: ProductSchema.type.optional(),
};

const list = listSchema(sortFields, defaultField, filters);

const read = readSchema;

const updatePricesKeys: JoiSchemaMap<UpdateProductPricesInput> = {
  percentageChangeType: basicStringSchema
    .valid('increase', 'decrease')
    .required(),
  value: integerSchema.min(0).required(),
};

const updatePrices = createSchema(Joi.object().keys(updatePricesKeys));

export const resolvers = {
  createProduct: create,
  updateProduct: update,
  deleteProduct: remove,
  listProducts: list,
  readProduct: read,
  updateProductPrices: updatePrices,
};
