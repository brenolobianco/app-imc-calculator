import Joi from 'joi';

import { basicStringSchema } from './baseSchemas';
import { JoiSchemaMap, GeneralSearchParams } from '../../../types';

const generalSearchKeys: JoiSchemaMap<GeneralSearchParams> = {
  q: basicStringSchema.min(3).required(),
};

const generalSearch = Joi.object().keys(generalSearchKeys);

export const resolvers = {
  generalSearch,
};
