import { Router } from 'express';
import fs from 'fs';

import {
  generatePdfBuffersOfBudgets,
  generatePdfFilesOfBudgets,
} from '../helpers/OrderHelpers';
import { isAuthenticated } from '../middlewares/authentication/authenticationHelper';
import { isAuthorized } from '../middlewares/authorization/authorizationHelper';
import { wrapAsync } from '../middlewares/errorHandling/errorHandlingHelpers';
import { validateRestRequest } from '../middlewares/validation/validationHelpers';
import { ID } from '../types';

const budgetsRouter = Router();

budgetsRouter.get(
  '/generate_pdf_files',
  wrapAsync(isAuthenticated),
  wrapAsync(isAuthorized),
  wrapAsync(validateRestRequest),
  wrapAsync(async (request, response) => {
    const { dirPath, zipFilepath } = await generatePdfFilesOfBudgets({
      ids: request.query.ids as ID[],
    });

    return response.download(zipFilepath, err => {
      if (err) console.error('Erro ao transferir o zip');

      fs.rmdir(dirPath, { recursive: true }, removeError => {
        if (removeError) console.error('Erro ao remover a pasta', removeError);
      });
    });
  }),
);

budgetsRouter.get(
  '/generate_pdf_buffers',
  wrapAsync(isAuthenticated),
  wrapAsync(isAuthorized),
  wrapAsync(validateRestRequest),
  wrapAsync(async (request, response) => {
    const { pdfBuffers, dirPath } = await generatePdfBuffersOfBudgets({
      ids: request.query.ids as ID[],
    });

    fs.rmdir(dirPath, { recursive: true }, removeError => {
      if (removeError) console.error('Erro ao remover a pasta', removeError);
    });

    return response.status(200).json(pdfBuffers);
  }),
);

export default budgetsRouter;
