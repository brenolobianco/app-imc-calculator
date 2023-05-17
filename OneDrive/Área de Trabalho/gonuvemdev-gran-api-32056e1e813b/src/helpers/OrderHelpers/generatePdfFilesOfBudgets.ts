/* eslint-disable no-restricted-syntax */
/* eslint-disable no-await-in-loop */
import fs from 'fs';
import path from 'path';
import AdmZip from 'adm-zip';

import { QueryPopulateOptions } from 'mongoose';
import { OrderDocument } from '../../interfaces';

import { ORDER_NOT_FOUND } from '../../middlewares/errorHandling/errors';
import { ID } from '../../types';
import { generateRandomString, isEmptyArray } from '../../utils/general';
import { createBudgetPDF } from './createBudgetPDF';
import Order from '../../models/Order';

async function getBudgets(ids: ID[]) {
  const paths: QueryPopulateOptions[] = [
    { path: 'client', populate: { path: 'user' } },
    { path: 'seller', populate: { path: 'user' } },
    { path: 'seller', populate: { path: 'employee' } },
    { path: 'items', populate: { path: 'product' } },
    { path: 'items', populate: { path: 'finish' } },
  ];

  const orders = await Order.find({ _id: { $in: ids } }).populate(paths);

  if (isEmptyArray(orders)) throw ORDER_NOT_FOUND;

  return orders;
}

async function createOutputDir() {
  const partialId = await generateRandomString('1234567890abcdef', 5);

  const id = `${Date.now()}-${partialId}`;

  const dirPath = `${id}`;

  await fs.promises.mkdir(dirPath);

  return dirPath;
}

async function generateBudgetPdf(dirPath: string, budget: OrderDocument) {
  const pdfFilepath = path.join(dirPath, `Orcamento ${budget.code}.pdf`);

  await createBudgetPDF(pdfFilepath, budget);

  return pdfFilepath;
}

async function generateZipFile(dirPath: string) {
  const zip = new AdmZip();

  zip.addLocalFolder(dirPath);

  const zipFilepath = path.join(dirPath, `Orcamentos.zip`);

  zip.writeZip(zipFilepath);

  return zipFilepath;
}

// eslint-disable-next-line max-lines-per-function
export async function generatePdfFilesOfBudgets({
  ids,
}: {
  ids: ID[];
}): Promise<{ dirPath: string; zipFilepath: string }> {
  // Buscar pedidos
  const budgets = await getBudgets(ids);

  // Criar pasta com um id único
  const dirPath = await createOutputDir();

  // Para cada orçamento, gerar o pdf e salvar dentro da pasta
  const pdfFilepaths = [];
  for (const budget of budgets) {
    const pdfFilepath = await generateBudgetPdf(dirPath, budget);
    pdfFilepaths.push(pdfFilepath);
  }

  // Criar zip com todo conteúdo da pasta
  const zipFilepath = await generateZipFile(dirPath);

  return { dirPath, zipFilepath };
}

// eslint-disable-next-line max-lines-per-function
export async function generatePdfBuffersOfBudgets({
  ids,
}: {
  ids: ID[];
}): Promise<{
  pdfBuffers: { code: string; buffer: Buffer }[];
  dirPath: string;
}> {
  // Buscar pedidos
  const budgets = await getBudgets(ids);

  // Criar pasta com um id único
  const dirPath = await createOutputDir();

  // Para cada orçamento, gerar o pdf, salvar dentro da pasta e obter o buffer
  const pdfBuffers = [];
  for (const budget of budgets) {
    const pdfFilepath = await generateBudgetPdf(dirPath, budget);
    const pdfBuffer = fs.readFileSync(pdfFilepath);
    pdfBuffers.push({ code: budget.code, buffer: pdfBuffer });
  }

  return { pdfBuffers, dirPath };
}
