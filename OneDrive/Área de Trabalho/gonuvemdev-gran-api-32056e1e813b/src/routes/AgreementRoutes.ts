import { Router } from 'express';
import fs from 'fs';

import { generatePdfFileOfAgreement } from '../helpers/OrderHelpers';
import { isAuthenticated } from '../middlewares/authentication/authenticationHelper';
import { isAuthorized } from '../middlewares/authorization/authorizationHelper';
import { wrapAsync } from '../middlewares/errorHandling/errorHandlingHelpers';
import { validateRestRequest } from '../middlewares/validation/validationHelpers';

const agreementsRouter = Router();

agreementsRouter.get(
  '/:id/generate_pdf_file',
  wrapAsync(isAuthenticated),
  wrapAsync(isAuthorized),
  wrapAsync(validateRestRequest),
  wrapAsync(async (request, response) => {
    const { dirPath, pdfFilepath } = await generatePdfFileOfAgreement({
      id: request.params.id,
    });

    return response.download(pdfFilepath, err => {
      if (err) console.error('Erro ao transferir o pdf');

      fs.rmdir(dirPath, { recursive: true }, removeError => {
        if (removeError) console.error('Erro ao remover a pasta', removeError);
      });
    });
  }),
);

export default agreementsRouter;
