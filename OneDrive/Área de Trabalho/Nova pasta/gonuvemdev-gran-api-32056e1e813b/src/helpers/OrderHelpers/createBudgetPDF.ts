/* eslint-disable no-restricted-syntax */
/* eslint-disable no-await-in-loop */
import fs from 'fs';
import { format, parseISO } from 'date-fns';
import { PDFDocument, PDFFont, PDFPage, rgb, StandardFonts } from 'pdf-lib';
import fetch from 'node-fetch';

import {
  AdminDocument,
  ClientDocument,
  FinishDocument,
  OrderDocument,
  OrderItem,
  ProductDocument,
  UserDocument,
  EmployeeDocument,
} from '../../interfaces';

import { formatCurrency, replaceExtension } from './utils';

const logoTranspPath = './assets/logoTransp.png';
const waterMarkTransPath = './assets/granwatertransp.png';
const coverPath = './assets/cover.jpg';
const backcoverPath = './assets/backcover.jpg';

const increaseY = 242;

const leftBound = 20;
const rightBound = 575;
const topBound = 772;
const bottomBound = 25;

const fontRemStandard = 8;
const lineHeight = fontRemStandard + 4;

const formatDecimal = (value: string) => {
  let formattedValue = '';
  formattedValue = value.replace(/\D/g, '');
  formattedValue = value.replace(/(\d{1})(\d{2}$)/, '$1,$2');
  return formattedValue;
};

const formatPhone = (text: string) =>
  text ? text.replace(/(\d{2})(\d{8,9})/, '($1) $2') : '';

const formatCpf = (text: string) =>
  text.replace(/(\d{3})(\d{3})(\d{3})(\d{2})$/, '$1.$2.$3-$4');

const formatCnpj = (text: string) =>
  text.replace(/(\d{2})(\d{3})(\d{3})(\d{4})(\d{2})$/, '$1.$2.$3/$4-$5');

const formatPostalCode = (text: string) =>
  text.replace(/(\d{5})(\d{3})$/, '$1-$2');

async function drawTableLine(
  page: PDFPage,
  item: OrderItem,
  font: PDFFont,
  lineY: number,
) {
  const product = item.product as ProductDocument;

  const finish = item.finish as FinishDocument;
  // Drawing table lines
  page.drawLine({
    start: { x: leftBound, y: lineY },
    end: { x: rightBound, y: lineY },
    color: rgb(0.921, 0.443, 0.203),
    thickness: 0.5,
  });

  // QTDE
  page.drawLine({
    start: {
      x: leftBound + 0.25,
      y: lineY,
    },
    end: {
      x: leftBound + 0.25,
      y: lineY + 30,
    },
    color: rgb(0.921, 0.443, 0.203),
    thickness: 0.5,
  });

  // QUANT
  const xQuant = leftBound + 12;
  const xQuantLine = xQuant + 21.2;
  page.drawText(item.quantity.toString(), {
    x: xQuant,
    y: lineY + 10,
    size: fontRemStandard,
    font,
  });

  page.drawLine({
    start: {
      x: xQuantLine,
      y: lineY,
    },
    end: {
      x: xQuantLine,
      y: lineY + 30,
    },
    color: rgb(0.921, 0.443, 0.203),
    thickness: 0.5,
  });

  // UNID
  const xUnid = xQuantLine + 15;
  const xUnidLine = xUnid + 23;
  page.drawText('PÇ', {
    x: xUnid,
    y: lineY + 10,
    size: fontRemStandard,
    font,
  });
  page.drawLine({
    start: {
      x: xUnidLine,
      y: lineY,
    },
    end: {
      x: xUnidLine,
      y: lineY + 30,
    },
    color: rgb(0.921, 0.443, 0.203),
    thickness: 0.5,
  });

  // DESC
  const xDesc = xUnidLine + 10;
  const xDescLine = xDesc + 353.7;
  page.drawText(`${item.description}`, {
    x: xDesc,
    y: lineY + 15,
    size: fontRemStandard,
    font,
  });
  page.drawText(`${product.name}`, {
    x: xDesc,
    y: lineY + 15 - lineHeight,
    size: fontRemStandard,
    font,
  });

  if (product.type === 'rawMaterial') {
    const xFinishCode =
      xDescLine - font.widthOfTextAtSize(finish.code, fontRemStandard) - 3;
    page.drawText(`${finish.code}`, {
      x: xFinishCode,
      y: lineY + 5,
      size: fontRemStandard,
      font,
    });
  }

  page.drawLine({
    start: {
      x: xDescLine,
      y: lineY,
    },
    end: {
      x: xDescLine,
      y: lineY + 30,
    },
    color: rgb(0.921, 0.443, 0.203),
    thickness: 0.5,
  });

  // PREÇ. UNIT.
  const xPrice = xDescLine + 2;
  const xPriceLine = xPrice + 60;

  const unitPrice = Math.round(item.price / item.quantity);

  page.drawText(formatCurrency(unitPrice / 100), {
    x: xPrice,
    y: lineY + 10,
    size: fontRemStandard,
    font,
  });
  page.drawLine({
    start: {
      x: xPriceLine,
      y: lineY,
    },
    end: {
      x: xPriceLine,
      y: lineY + 30,
    },
    color: rgb(0.921, 0.443, 0.203),
    thickness: 0.5,
  });

  // TOTAL
  const xTotal = xPriceLine + 2;
  const xTotalLine = xTotal + 56;
  page.drawText(formatCurrency(item.price / 100), {
    x: xTotal,
    y: lineY + 10,
    size: fontRemStandard,
    font,
  });
  page.drawLine({
    start: {
      x: xTotalLine,
      y: lineY,
    },
    end: {
      x: xTotalLine,
      y: lineY + 30,
    },
    color: rgb(0.921, 0.443, 0.203),
    thickness: 0.5,
  });
}

export async function createBudgetPDF(
  pdfFilepath: string,
  order: OrderDocument,
): Promise<void> {
  const client = order.client as ClientDocument;

  const seller = order.seller as AdminDocument;
  const sellerEmployee = seller.employee as EmployeeDocument;

  const user = seller.user as UserDocument;

  const pdfDoc = await PDFDocument.create();

  const boldFont = await pdfDoc.embedFont(StandardFonts.HelveticaBold);
  const normalFont = await pdfDoc.embedFont(StandardFonts.Helvetica);

  let page = pdfDoc.addPage([595, 842]);

  // Adding cover
  const cover = fs.readFileSync(coverPath);
  const backcover = fs.readFileSync(backcoverPath);

  const coverJPG = await pdfDoc.embedJpg(cover);
  const backcoverJPG = await pdfDoc.embedJpg(backcover);

  page.drawImage(coverJPG, {
    width: 595,
    height: 842,
  });

  page = pdfDoc.addPage([595, 842]);

  page.drawImage(backcoverJPG, {
    width: 595,
    height: 842,
  });

  page = pdfDoc.addPage([595, 842]);

  // Generating top left square informations
  page.drawRectangle({
    x: leftBound,
    y: topBound - 25,
    width: 140,
    height: 75,
    borderColor: rgb(0.921, 0.443, 0.203),
  });

  const budgetTitle = `${order.type === 'budget' ? 'Orçamento' : 'Pedido'} nº ${order.code
    }`;

  page.drawText(budgetTitle, {
    x: leftBound + 18,
    y: 565 + increaseY,
    size: fontRemStandard + 3,
    font: boldFont,
    color: rgb(0.921, 0.443, 0.203),
  });
  page.drawText(
    `Data: ${format(parseISO(order.date.toISOString()), 'dd/MM/yyyy')}`,
    {
      x: leftBound + 33,
      y: 552 + increaseY - 10,
      size: fontRemStandard + 1,
      color: rgb(0.921, 0.443, 0.203),
    },
  );

  const budgetExpiryDate =
    order.budgetExpiryDate &&
    format(parseISO(order.budgetExpiryDate.toISOString()), 'dd/MM/yyyy');

  page.drawText(`Validade do orçamento: ${budgetExpiryDate}`, {
    x: leftBound + 8,
    y: 539 + increaseY - 20,
    size: fontRemStandard,
    color: rgb(0.921, 0.443, 0.203),
  });

  // Generating top right square informations
  page.drawRectangle({
    x: leftBound + 145,
    y: 530 + increaseY - 25,
    width: rightBound - (leftBound + 145),
    height: 75,
    borderColor: rgb(0.921, 0.443, 0.203),
  });
  page.drawText('Rua Jandaia do Sul, 157 - Pinhais - PR', {
    x: leftBound + 150,
    y: 565 + increaseY,
    size: fontRemStandard + 1,
  });
  page.drawText('Fixo: (41) 3151-2211', {
    x: leftBound + 150,
    y: 550 + increaseY,
    size: fontRemStandard + 1,
  });
  page.drawText('Whats: (41) 99247-3501', {
    x: leftBound + 150,
    y: 535 + increaseY,
    size: fontRemStandard + 1,
  });

  const employeeEmail = (sellerEmployee && sellerEmployee.email) || '';

  page.drawText(`E-mail: ${employeeEmail}`, {
    x: leftBound + 150,
    y: 520 + increaseY,
    size: fontRemStandard + 1,
  });
  page.drawText('www.granparana.com.br', {
    x: leftBound + 330,
    y: 565 + increaseY,
    size: fontRemStandard + 1,
  });
  page.drawText('facebook.com/marmorariagranparana', {
    x: leftBound + 330,
    y: 550 + increaseY,
    size: fontRemStandard + 1,
  });
  page.drawText('instagram.com/granparanamarmores', {
    x: leftBound + 330,
    y: 535 + increaseY,
    size: fontRemStandard + 1,
  });

  const logo = fs.readFileSync(logoTranspPath);

  const logoPng = await pdfDoc.embedPng(logo);

  page.drawImage(logoPng, {
    x: rightBound - 50 - 22,
    y: 530 + increaseY - 22,
    width: 70,
    height: 70,
  });

  // Drawing client info
  let clientNameCleaned = client.name;

  if (client.name) {
    clientNameCleaned = client.name.replace(/[\d-()]/g, '');
  }

  const clientId = clientNameCleaned || formatPhone(client.primaryPhone);
  const personalInfoLineY = 490 + increaseY;

  const clientIdSize = boldFont.widthOfTextAtSize(
    `Cliente: ${clientId.slice(0, 30)}`,
    fontRemStandard,
  );

  page.drawText('Cliente: ', {
    x: leftBound,
    y: personalInfoLineY,
    size: fontRemStandard,
    font: boldFont,
  });
  page.drawText(clientId.slice(0, 30), {
    x: leftBound + boldFont.widthOfTextAtSize('Cliente:', fontRemStandard) + 3,
    y: personalInfoLineY,
    size: fontRemStandard,
  });

  const email = client.email || '';
  const emailX = leftBound + clientIdSize + 8;

  page.drawText('Email: ', {
    x: emailX,
    y: personalInfoLineY,
    size: fontRemStandard,
    font: boldFont,
  });
  page.drawText(email, {
    x: emailX + boldFont.widthOfTextAtSize('Email:', fontRemStandard) + 3,
    y: personalInfoLineY,
    size: fontRemStandard,
  });

  const cpfX =
    emailX + boldFont.widthOfTextAtSize(`Email: ${email}`, fontRemStandard) + 8;

  if (client.type === 'PF') {
    const cpf = client.cpf ? formatCpf(client.cpf) : '';
    page.drawText('CPF:', {
      x: cpfX,
      y: personalInfoLineY,
      size: fontRemStandard,
      font: boldFont,
    });
    page.drawText(formatCpf(cpf), {
      x: cpfX + 20,
      y: personalInfoLineY,
      size: fontRemStandard,
    });
  }

  if (client.type === 'PJ') {
    const stateRegistration = client.stateRegistration || '';
    page.drawText('RG/Insc.Estadual: ', {
      x: 185,
      y: personalInfoLineY,
      size: fontRemStandard,
      font: boldFont,
    });
    page.drawText(stateRegistration, {
      x: 240,
      y: personalInfoLineY,
      size: fontRemStandard,
    });

    const cnpj = client.cnpj ? formatCnpj(client.cnpj) : '';
    page.drawText('CNPJ: ', {
      x: 305,
      y: personalInfoLineY,
      size: fontRemStandard,
      font: boldFont,
    });
    page.drawText(cnpj, {
      x: 340,
      y: personalInfoLineY,
      size: fontRemStandard,
    });
  }

  const phoneLineY = personalInfoLineY - lineHeight;

  // Drawing water mark
  const waterMark = fs.readFileSync(waterMarkTransPath);
  const waterMarkPng = await pdfDoc.embedPng(waterMark);

  page.drawImage(waterMarkPng, {
    x: rightBound - 120,
    y: phoneLineY - 80,
    width: 120,
    height: 100,
  });

  page.drawText('Telefone:', {
    x: leftBound,
    y: phoneLineY,
    size: fontRemStandard,
    font: boldFont,
  });
  page.drawText(formatPhone(client.primaryPhone), {
    x: leftBound + boldFont.widthOfTextAtSize('Telefone:', fontRemStandard) + 3,
    y: phoneLineY,
    size: fontRemStandard,
  });

  // Drawing client address
  const city = client.address?.city || '';
  const state = client.address?.state || '';
  const postalCode = client.address?.postalCode || '';

  const addressLineY = phoneLineY - lineHeight;
  page.drawText('Endereço: ', {
    x: leftBound,
    y: addressLineY,
    size: fontRemStandard,
    font: boldFont,
  });
  const addressInfoLineY = addressLineY - lineHeight;
  page.drawText('Cidade: ', {
    x: leftBound,
    y: addressInfoLineY,
    size: fontRemStandard,
    font: boldFont,
  });
  page.drawText(city, {
    x: leftBound + boldFont.widthOfTextAtSize('Cidade:', fontRemStandard) + 3,
    y: addressInfoLineY,
    size: fontRemStandard,
    font: normalFont,
  });
  const xUF =
    leftBound +
    boldFont.widthOfTextAtSize('Cidade', fontRemStandard) +
    3 +
    normalFont.widthOfTextAtSize(city, fontRemStandard) +
    10;
  page.drawText('UF: ', {
    x: xUF,
    y: addressInfoLineY,
    size: fontRemStandard,
    font: boldFont,
  });
  page.drawText(state, {
    x: xUF + boldFont.widthOfTextAtSize('UF:', fontRemStandard) + 3,
    y: addressInfoLineY,
    size: fontRemStandard,
    font: normalFont,
  });

  const xPostal =
    xUF +
    10 +
    boldFont.widthOfTextAtSize('UF:', fontRemStandard) +
    3 +
    normalFont.widthOfTextAtSize(state, fontRemStandard) +
    10;
  page.drawText('CEP: ', {
    x: xPostal,
    y: addressInfoLineY,
    size: fontRemStandard,
    font: boldFont,
  });
  page.drawText(formatPostalCode(postalCode), {
    x: xPostal + boldFont.widthOfTextAtSize('CEP:', fontRemStandard) + 3,
    y: addressInfoLineY,
    size: fontRemStandard,
    font: normalFont,
  });

  // Drawing additional info
  const paymentConditions = order.payment?.conditions || '';
  const deliveryTime = order.deliveryTime
    ? `${order.deliveryTime.toString()} dias úteis após a medição`
    : '';

  const addInfoLineY = addressInfoLineY - lineHeight;

  page.drawText('Cond.Pgto: ', {
    x: leftBound,
    y: addInfoLineY,
    size: fontRemStandard,
    font: boldFont,
  });
  page.drawText(paymentConditions, {
    x:
      leftBound + boldFont.widthOfTextAtSize('Cond.Pgto:', fontRemStandard) + 3,
    y: addInfoLineY,
    size: fontRemStandard,
  });
  page.drawText('Entrega: ', {
    x: leftBound,
    y: addInfoLineY - lineHeight,
    size: fontRemStandard,
    font: boldFont,
  });
  page.drawText(deliveryTime, {
    x: leftBound + boldFont.widthOfTextAtSize('Entrega:', fontRemStandard),
    y: addInfoLineY - lineHeight,
    size: fontRemStandard,
  });

  // Drawing finish images
  const finishImages = order.items
    .map(item => (item.finish as FinishDocument).design)
    .filter(design => design && design?.length > 0);
  const finishImagesSet = Array.from(new Set(finishImages)).slice(0, 5);

  let increaseX = 0;

  for (const image of finishImagesSet) {
    const imageUrlFormatted = replaceExtension(image as string, '.png');

    const imageBuffer = await fetch(imageUrlFormatted).then(res =>
      res.arrayBuffer(),
    );
    const finishImage = await pdfDoc.embedPng(imageBuffer);
    page.drawImage(finishImage, {
      x: leftBound + increaseX,
      y: addInfoLineY - 45,
      width: 60,
      height: 25,
    });
    increaseX += 80;
  }

  const tableLine = addInfoLineY - 65;

  // Drawing itens table header
  page.drawRectangle({
    x: leftBound,
    y: tableLine,
    width: rightBound - leftBound,
    height: 15,
    color: rgb(0.921, 0.443, 0.203),
  });
  const xQTDE = leftBound + 5;
  const xQTDELine =
    xQTDE + boldFont.widthOfTextAtSize('Qtde', fontRemStandard) + 10;
  page.drawText('Qtde', {
    x: xQTDE,
    y: tableLine + 5,
    size: fontRemStandard,
    color: rgb(1, 1, 1),
    font: boldFont,
  });
  page.drawLine({
    start: { x: xQTDELine, y: tableLine + 1 },
    end: { x: xQTDELine, y: tableLine + 14 },
    color: rgb(1, 1, 1),
    thickness: 1,
  });

  const xUnid = xQTDELine + 10;
  const xUnidLine =
    xUnid + boldFont.widthOfTextAtSize('Unid', fontRemStandard) + 10;
  page.drawText('Unid', {
    x: xUnid,
    y: tableLine + 5,
    size: 8,
    color: rgb(1, 1, 1),
    font: boldFont,
  });
  page.drawLine({
    start: { x: xUnidLine, y: tableLine + 1 },
    end: { x: xUnidLine, y: tableLine + 14 },
    color: rgb(1, 1, 1),
    thickness: 1,
  });

  const xDesc = xUnidLine + 10;
  const xDescLine =
    xUnid +
    boldFont.widthOfTextAtSize('Descrição dos Materiais', fontRemStandard) +
    300;
  page.drawText('Descrição dos Materiais', {
    x: xDesc,
    y: tableLine + 5,
    size: 8,
    color: rgb(1, 1, 1),
    font: boldFont,
  });
  page.drawLine({
    start: { x: xDescLine, y: tableLine + 1 },
    end: { x: xDescLine, y: tableLine + 14 },
    color: rgb(1, 1, 1),
    thickness: 1,
  });

  const xPrice = xDescLine + 10;
  const xPriceLine =
    xPrice + boldFont.widthOfTextAtSize('Preço Unit.', fontRemStandard) + 10;
  page.drawText('Preço Unit.', {
    x: xPrice,
    y: tableLine + 5,
    size: fontRemStandard,
    color: rgb(1, 1, 1),
    font: boldFont,
  });
  page.drawLine({
    start: { x: xPriceLine, y: tableLine + 1 },
    end: { x: xPriceLine, y: tableLine + 14 },
    color: rgb(1, 1, 1),
    thickness: 1,
  });

  const xTotal = xPriceLine + 15;
  page.drawText('TOTAL', {
    x: xTotal,
    y: tableLine + 5,
    size: 8,
    color: rgb(1, 1, 1),
    font: boldFont,
  });

  // Drawing table lines
  let lineY = tableLine - 29;

  order.items.forEach(item => {
    drawTableLine(page, item, boldFont, lineY);
    lineY -= 30;

    if (lineY <= 0) {
      page = pdfDoc.addPage([595, 842]);
      lineY = topBound;
    }
  });

  if (lineY <= 200) {
    page = pdfDoc.addPage([595, 842]);
  }

  // Drawing comment if have
  if (order.comments) {
    page.drawText(`*Obs: ${order.comments}`, {
      x: leftBound,
      y: bottomBound + 165,
      size: fontRemStandard,
      lineHeight: fontRemStandard + 2,
      font: boldFont,
    });
  }

  // Drawing summary
  const summaryText =
    'Caro cliente: 1) Para melhor atendê-lo solicite a medição definitiva assim que estiver\nliberado, pois o prazo de entrega está vinculado à data da medição. 2) Por tratar-se de um\nproduto extraído da natureza os mármores e granitos estão sujeitos a variações de cores.\n3) Cuidado com o uso de produtos como: Gorduras, azeite ou limão, pois estes podem\ncausar manchas ou corrosão na pedra. 4) A colocação tem GARANTIA de um ano. 5) O\ntampo será produzido de acordo com os gráficos acima. 6) Férias coletivas no período de\n15 de dezembro a 15 de janeiro';
  page.drawText(summaryText, {
    x: leftBound,
    y: bottomBound + 150,
    size: fontRemStandard,
    lineHeight: fontRemStandard + 2,
  });
  page.drawRectangle({
    borderColor: rgb(0.921, 0.443, 0.203),
    width: 170,
    height: 60,
    x: rightBound - 170,
    y: bottomBound + 100,
  });

  // sum all items price
  const subtotal = order.items.reduce((acc, cur) => acc + cur.price, 0);

  // sum all items discount
  const discount = order.discountTotal || 0;

  // Formatting info
  const subFormatted = formatCurrency(subtotal / 100);
  const discountFormatted = formatCurrency(discount / 100);
  const totalFormatted = formatCurrency(order.total / 100);

  page.drawText('SUB-TOTAL: ', {
    x: rightBound - 165,
    y: bottomBound + 150,
    size: fontRemStandard,
    font: boldFont,
  });
  const subTotalSize = boldFont.widthOfTextAtSize(
    subFormatted,
    fontRemStandard,
  );
  page.drawText(subFormatted, {
    x: rightBound - subTotalSize - 5,
    y: bottomBound + 150,
    size: fontRemStandard,
    font: boldFont,
  });

  page.drawText('DESCONTO: ', {
    x: rightBound - 165,
    y: bottomBound + 130,
    size: 8,
    font: boldFont,
  });
  const discountSize = boldFont.widthOfTextAtSize(
    discountFormatted,
    fontRemStandard,
  );
  page.drawText(discountFormatted, {
    x: rightBound - discountSize - 5,
    y: bottomBound + 130,
    size: 8,
    font: boldFont,
  });

  page.drawText('TOTAL: ', {
    x: rightBound - 165,
    y: bottomBound + 110,
    size: 8,
    font: boldFont,
  });
  const totalSize = boldFont.widthOfTextAtSize(totalFormatted, fontRemStandard);
  page.drawText(totalFormatted, {
    x: rightBound - totalSize - 5,
    y: bottomBound + 110,
    size: 8,
    font: boldFont,
  });

  // Drawing subscription area
  page.drawLine({
    start: { x: leftBound, y: bottomBound + 50 },
    end: { x: 200, y: bottomBound + 50 },
    thickness: 0.5,
  });
  page.drawText(`Comprador: ${clientId}`, {
    x: leftBound,
    y: bottomBound + 40,
    size: fontRemStandard,
  });

  page.drawLine({
    start: { x: rightBound - 150, y: bottomBound + 50 },
    end: { x: rightBound, y: bottomBound + 50 },
    thickness: 0.5,
  });
  page.drawText(`Vendedor: ${(seller.user as UserDocument).name}`, {
    x: rightBound - 150,
    y: bottomBound + 40,
    size: fontRemStandard,
  });

  // Drawing footer
  page.drawRectangle({
    x: leftBound,
    y: bottomBound,
    width: rightBound - leftBound,
    height: 20,
    borderColor: rgb(0.921, 0.443, 0.203),
  });
  page.drawText('GRAN PR MÁRMORES E GRANITOS LTDA', {
    x: leftBound + 5,
    y: bottomBound + 7,
    size: fontRemStandard,
  });
  page.drawText('CNPJ: 22.346.265/0001-89', {
    x: 300,
    y: bottomBound + 7,
    size: fontRemStandard,
  });
  page.drawText('INSCR. EST. 90693422-10', {
    x:
      rightBound -
      normalFont.widthOfTextAtSize('INSCR. EST. 90693422-10', fontRemStandard) -
      5,
    y: bottomBound + 7,
    size: fontRemStandard,
    font: normalFont,
  });

  const pdfBytes = await pdfDoc.save();

  fs.writeFileSync(pdfFilepath, pdfBytes);
}
