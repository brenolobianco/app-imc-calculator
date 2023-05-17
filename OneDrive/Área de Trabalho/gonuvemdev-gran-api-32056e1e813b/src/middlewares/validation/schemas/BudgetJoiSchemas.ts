import Joi from 'joi';

import { arraySchema, idSchema } from './baseSchemas';

const generatePdfFiles = Joi.object().keys({
  query: {
    ids: arraySchema(idSchema.required()).min(1).required(),
  },
});

const generatePdfBuffers = Joi.object().keys({
  query: {
    ids: arraySchema(idSchema.required()).min(1).required(),
  },
});

export const routes = {
  generatePdfFilesOfBudgets: generatePdfFiles,
  generatePdfBuffersOfBudgets: generatePdfBuffers,
};
