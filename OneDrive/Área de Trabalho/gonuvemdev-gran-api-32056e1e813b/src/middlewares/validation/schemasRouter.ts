import { Schema } from 'joi';

import schemas from './schemas';
/**
 * Define qual schema de validação corresponde a uma dada operação graphql
 */
export const gqlRouter: { [resolverName: string]: Schema } = { ...schemas };

export const restRouter: { [route: string]: Schema } = {
  'GET /budgets/generate_pdf_files': schemas.generatePdfFilesOfBudgets,
  'GET /budgets/generate_pdf_buffers': schemas.generatePdfBuffersOfBudgets,

  'GET /agreements/:id/generate_pdf_file': schemas.generatePdfFileOfAgreement,
};
