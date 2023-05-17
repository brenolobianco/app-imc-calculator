import mongoose, { SchemaDefinition } from 'mongoose';

import { ProductType } from '../enums/ProductType';
import {
  ProductPricePerFinish,
  ProductDocument,
  ProductInterface,
} from '../interfaces';
import { MongooseDefinition } from '../types';
import './Finish';

const productPricePerFinishDefinition: MongooseDefinition<ProductPricePerFinish> = {
  price: {
    type: Number,
    required: true,
    validate: Number.isInteger,
  },
  finish: {
    type: mongoose.Types.ObjectId,
    ref: 'Finish',
    required: true,
  },
};

const ProductPricePerFinishSchema = new mongoose.Schema(
  productPricePerFinishDefinition as SchemaDefinition,
  { _id: false },
);

const definition: MongooseDefinition<ProductInterface> = {
  name: {
    type: String,
    required: true,
  },
  isActivated: {
    type: Boolean,
    required: true,
    default: true,
  },
  cost: {
    type: Number,
    required: true,
    validate: Number.isInteger,
  },
  type: {
    type: String,
    enum: Object.values(ProductType),
    required: true,
  },
  price: {
    type: Number,
    validate: Number.isInteger,
  },
  pricesPerFinishes: [ProductPricePerFinishSchema],
};

const ProductSchema = new mongoose.Schema(definition as SchemaDefinition, {
  timestamps: true,
});

const Product = mongoose.model<ProductDocument>('Product', ProductSchema);

export default Product;
