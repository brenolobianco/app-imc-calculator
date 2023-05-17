/* eslint-disable no-restricted-syntax */
/* eslint-disable no-await-in-loop */
import fs from 'fs';
import path from 'path';
import { QueryPopulateOptions } from 'mongoose';

import { OrderDocument } from '../../interfaces';
import { ORDER_NOT_FOUND } from '../../middlewares/errorHandling/errors';
import { ID } from '../../types';
import { generateRandomString } from '../../utils/general';
import { createAgreementPDF } from './createAgreementPDF';
import Order from '../../models/Order';

async function getOrder(id: ID) {
  const paths: QueryPopulateOptions[] = [
    { path: 'client', populate: { path: 'user' } },
    { path: 'seller', populate: { path: 'user' } },
    { path: 'seller', populate: { path: 'employee' } },
    { path: 'items', populate: { path: 'product' } },
    { path: 'items', populate: { path: 'finish' } },
  ];

  const order = await Order.findById(id).populate(paths);

  if (!order) throw ORDER_NOT_FOUND;

  return order;
}

async function createOutputDir() {
  const partialId = await generateRandomString('1234567890abcdef', 5);

  const id = `${Date.now()}-${partialId}`;

  const dirPath = `${id}`;

  await fs.promises.mkdir(dirPath);

  return dirPath;
}

async function generateAgreementPdf(dirPath: string, agreement: OrderDocument) {
  const pdfFilepath = path.join(dirPath, `Contrato ${agreement.code}.pdf`);

  await createAgreementPDF(pdfFilepath, agreement);

  return pdfFilepath;
}

// eslint-disable-next-line max-lines-per-function
export async function generatePdfFileOfAgreement({
  id,
}: {
  id: ID;
}): Promise<{ dirPath: string; pdfFilepath: string }> {
  // Buscar pedidos
  const order = await getOrder(id);

  // Criar pasta com um id único
  const dirPath = await createOutputDir();

  // Gerar o pdf e salvar dentro da pasta
  const pdfFilepath = await generateAgreementPdf(dirPath, order);

  return { dirPath, pdfFilepath };
}
