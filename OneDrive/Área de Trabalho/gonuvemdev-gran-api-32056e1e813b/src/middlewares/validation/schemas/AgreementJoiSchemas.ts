import Joi from 'joi';

import { idSchema } from './baseSchemas';

const generatePdfFile = Joi.object().keys({
  params: {
    id: idSchema.required(),
  },
});

export const routes = {
  generatePdfFileOfAgreement: generatePdfFile,
};
