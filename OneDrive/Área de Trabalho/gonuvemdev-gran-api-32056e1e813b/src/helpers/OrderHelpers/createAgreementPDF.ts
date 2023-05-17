/* eslint-disable max-lines */
/* eslint-disable no-restricted-syntax */
/* eslint-disable max-lines-per-function */
/* eslint-disable no-await-in-loop */
import { PDFDocument, PDFFont, PDFPage, rgb, StandardFonts } from 'pdf-lib';
import fetch from 'node-fetch';
import { format } from 'date-fns';
import fs from 'fs';

import {
  ClientDocument,
  FinishDocument,
  OrderDocument,
  OrderItem,
  ProductDocument,
  AdminDocument,
  UserDocument,
  EmployeeDocument,
} from '../../interfaces';

import { formatCurrency, replaceExtension } from './utils';

const ptBR = require('date-fns/locale/pt-BR');

const logoTranspPath = './assets/logoTransp.png';

const leftBound = 20;
const rightBound = 575;
const topBound = 800;
const bottomBound = 25;
const tableRowHeight = 30;

const fontRemStandard = 12;
const fontRemSmaller = 8;
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
      y: lineY + tableRowHeight,
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
    size: fontRemSmaller,
    font,
  });
  page.drawLine({
    start: {
      x: xQuantLine,
      y: lineY,
    },
    end: {
      x: xQuantLine,
      y: lineY + tableRowHeight,
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
    size: fontRemSmaller,
    font,
  });
  page.drawLine({
    start: {
      x: xUnidLine,
      y: lineY,
    },
    end: {
      x: xUnidLine,
      y: lineY + tableRowHeight,
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
    size: fontRemSmaller,
    font,
  });
  page.drawText(`${product.name}`, {
    x: xDesc,
    y: lineY + 15 - 10,
    size: fontRemSmaller,
    font,
  });

  if (product.type === 'rawMaterial') {
    const xFinishCode =
      xDescLine - font.widthOfTextAtSize(finish.code, fontRemStandard) - 3;
    page.drawText(`${finish.code}`, {
      x: xFinishCode,
      y: lineY + 5,
      size: fontRemSmaller,
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
      y: lineY + tableRowHeight,
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
    size: fontRemSmaller,
    font,
  });
  page.drawLine({
    start: {
      x: xPriceLine,
      y: lineY,
    },
    end: {
      x: xPriceLine,
      y: lineY + tableRowHeight,
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
    size: fontRemSmaller,
    font,
  });
  page.drawLine({
    start: {
      x: xTotalLine,
      y: lineY,
    },
    end: {
      x: xTotalLine,
      y: lineY + tableRowHeight,
    },
    color: rgb(0.921, 0.443, 0.203),
    thickness: 0.5,
  });
}

async function drawFooter(
  page: PDFPage,
  font: PDFFont,
  total: number,
  index: number,
  orderCode: string,
  sellerEmail: string,
) {
  page.drawText('www.granparana.com.br\nwww.instagram.com/granparanamarmores', {
    x: leftBound,
    y: bottomBound,
    size: fontRemStandard - 5,
    lineHeight: lineHeight - 5,
    font,
  });

  page.drawText(`Página ${index + 1} de ${total} / ${orderCode}`, {
    x: leftBound + 225,
    y: bottomBound,
    size: fontRemStandard - 5,
    lineHeight: lineHeight - 5,
    font,
  });

  page.drawText(`(41) 98527-0186 - Fixo: (41) 3151-2211`, {
    x: leftBound + 200,
    y: bottomBound - 10,
    size: fontRemStandard - 5,
    lineHeight: lineHeight - 5,
    font,
  });

  page.drawText(`${sellerEmail}\nfacebook.com/marmorariagranparana`, {
    x: rightBound - 140,
    y: bottomBound,
    size: fontRemStandard - 5,
    lineHeight: lineHeight - 5,
    font,
  });
}

export async function createAgreementPDF(
  pdfFilepath: string,
  order: OrderDocument,
): Promise<void> {
  // Storing pdf pages to draw footer in the end
  const pages: PDFPage[] = [];

  const client = order.client as ClientDocument;
  const seller = order.seller as AdminDocument;

  const sellerEmployee = seller.employee as EmployeeDocument;
  const user = seller.user as UserDocument;

  const pdfDoc = await PDFDocument.create();

  const boldFont = await pdfDoc.embedFont(StandardFonts.HelveticaBold);
  const normalFont = await pdfDoc.embedFont(StandardFonts.Helvetica);

  let page = pdfDoc.addPage([595, 842]);

  const logo = fs.readFileSync(logoTranspPath);
  const logoPng = await pdfDoc.embedPng(logo);

  page.drawImage(logoPng, {
    x: leftBound,
    y: topBound - 35,
    width: 55,
    height: 55,
  });
  page.drawLine({
    start: { x: leftBound, y: topBound - 40 },
    end: { x: rightBound, y: topBound - 40 },
    color: rgb(0, 0, 0),
    thickness: 1,
  });
  page.drawText(`Pedido e Contrato n° ${order.code}`, {
    x: leftBound + 200,
    y: topBound - 35,
    font: boldFont,
    size: fontRemStandard,
  });

  const initialText =
    'Pelo presente instrumento particular e na melhor forma de direito, as partes abaixo nomeadas e\n' +
    'identificadas, têm entre si justas e acordadas, o presente contrato, sendo regido pelas cláusulas e\n' +
    'condições a seguir:\n';

  // Drawing client info
  let clientNameCleaned = client.name;

  if (client.name) {
    clientNameCleaned = client.name.replace(/[\d-()]/g, '');
  }

  const phoneText = `${clientNameCleaned?.toUpperCase()} Telefone: ${formatPhone(
    client.primaryPhone,
  )} neste ato denominado CONTRATANTE,`;

  const city = client.address?.city || '';
  const state = client.address?.state || '';
  const postalCode = client.address?.postalCode || '';
  const street = client.address?.street || '';
  const number = client.address?.number || '';

  const streetSize = normalFont.widthOfTextAtSize(street, fontRemStandard);

  const addressText = `para realizar serviços no endereço: ${street} - ${number} - ${city} - ${state} - CEP: ${postalCode}`;

  let numberText = '';

  if (client.type === 'PF') {
    const cpf = client.cpf ? formatCpf(client.cpf) : '';
    numberText = `e Sob CPF nº: ${cpf}`;
  }

  if (client.type === 'PJ') {
    const cnpj = client.cnpj ? formatCnpj(client.cnpj) : '';
    numberText = `e Sob CNPJ nº: ${cnpj}`;
  }

  const bodyTextPage1 =
    'GRAN PR Mármores e Granitos LTDA, com sede na Rua Jandaia do Sul, 157 - Emiliano Perneta - Pinhais\n' +
    ' - PR CNPJ: 22.346.265/0001-89, representada por Renan Lopis CPF 075.885.259-24\n' +
    'devidamente autorizado, neste ato denominado CONTRATADA. CLÁUSULA PRIMEIRA - DO \n' +
    'OBJETO O objetivo deste contrato é disciplinar o fornecimento pela CONTRATADA onde a \n' +
    'mesma se obriga e compromete-se a fornecer e instalar as peças devidamente discriminadas na\n' +
    'última cláusula. CLÁUSULA SEGUNDA - DA CONFECÇÃO, TRANSPORTE E INSTALAÇÃO\n' +
    'A contratada se responsabiliza por beneficiar, transportar e entregar, assim como realizar a \n' +
    'instalação das peças pedidas com as respectivas quantidades especificadas na última cláusula\n' +
    'deste contrato. destinado ao endereço indicado pela contratante, em Curitiba e região\n' +
    'metropolitana. Nenhuma modificação nas medidas e nas especificações citados na última\n' +
    'cláusula poderão ser realizadas, porém o plano de corte dos materiais seguirão o critério\n' +
    'estabelecido pela CONTRATADA, beneficiando o melhor aproveitamento do material em chapa.\n' +
    'Caso haja acréscimos ao que foi pedido deverá ser criado um adendo ao presente\n' +
    'contrato. CLÁUSULA TERCEIRA - OBRIGAÇÕES DA CONTRATADA: Atender a solicitação\n' +
    'para medição em definitivo após a montagem dos móveis (se for o caso); Efetuar as confirmações\n' +
    'das dimensões das peças que serão produzidas no endereço da obra; Transportar entregar e\n' +
    'instalar o objeto do presente contrato e ao final da instalação recolher somente o lixo gerado\n' +
    'pelos montadores durante a instalação; Fornecer aos seus funcionários em atividade na obra os\n' +
    'equipamentos de proteção individual previsto pela legislação em vigor e orientá-los sobre a\n' +
    'utilização dos mesmos. Caso o contratante não compre o produto instalado, insto estará explicito\n' +
    'na cláusula última. CLÁUSULA QUARTA - OBRIGAÇÕES DO CONTRATANTE O contratante\n' +
    'terá que permitir aos funcionários da contratada ou a prestadores de serviço para a contratada,\n' +
    'a utilização de escada, elevador, andaimes e outros dispositivos disponíveis na obra e que\n' +
    'possam facilitar a execução dos serviços de carga, descarga, movimentação e instalação dos\n' +
    'produtos citados neste contrato. É de responsabilidade do contratante reservar e indicar o local\n' +
    'para o descarregamento do material. Durante o processo de instalação, os montadores poderão\n' +
    'solicitar um espaço para realização de cortes do material, (os cortes se fazem necessário\n' +
    'visando o melhor acabamento), o lugar não poderá ser superior a distância de 30 metros do local\n' +
    'de instalação. O contratante ainda ficará responsável após a entrega na obra de cuidar para que\n' +
    'sejam preservados os materiais para que não sofram quaisquer tipos de danos e ou\n' +
    'deformações causados por batida ou queda. Cuidar com materiais corrosivos, como ácidos e\n' +
    'outros materiais que causam danos a superfíce do material. Após recebimento desse material\n' +
    'na obra a responsabilidade sobre o mesmo passa a ser do CONTRATANTE. Informar sobre os\n' +
    'horários permitidos para a instalação, e se esses forem fora do horário comercial, será cobrado\n' +
    'uma taxa de horários especiais de acordo com a tabela vigente da contratada. CLÁUSULA\n' +
    'QUINTA - GARANTIA: Os serviços realizados (mão de obra) e os insumos como: silicone,\n' +
    'massa plástica, PU, cola cuba, resinas e lixas aplicadas, são garantidas pela contratada por um\n';

  const bodyTextPage2 =
    'período de 01 ano (doze meses). Essa garantia poderá ser estendida caso o contratante opte\n' +
    'por produtos em superfice de quartzo fornecida pela GranParaná e para tanto será fornecido\n' +
    'um termo de garantia específico. CLÁUSULA SEXTA - PRAZO DE ENTREGA: A contar a partir\n' +
    'da data de medição definitiva com a presença do contratante ou pessoa responsável indicada\n' +
    'por ele, pois o projeto serve como base, mas o detalhamento será discutido em loco. Para tanto\n' +
    'a obra deverá fornecer as condições para as medições, subentende-se que a obra está em\n' +
    'condições de ser medida quando está em condições de receber pedras instaladas. A\n' +
    'medição, instalação ou a conclusão poderá ser adiada na época prevista, a obra não reunir\n' +
    'condições técnicas para medir ou receber os serviços de instalação. Caso a obra não reuna as\n' +
    'condições acima, o medidor vai informar e reagendar nova data. Se o contratante ou a pessoa\n' +
    'indicada por ele, solicitar a execução sem a prévia conferência em loco, este será responsável\n' +
    'por erros de medidas originadas pelo ato. CLÁUSULA SÉTIMA - DOS PREÇOS E CONDIÇÕES\n' +
    'DE PAGAMENTO: O valor para o presente ajuste encontra-se discriminado também na cláusula\n' +
    'última deste contrato, valores certos e fixos, irreajustável, em moeda corrente do país.\n' +
    'Entendido este como preço justo e suficiente para a execução do presente contrato. Caso sejam\n' +
    'atendidas todas as condições das cláusulas anteriores, o contrato é findado com as condições de\n' +
    'pagamento informadas na cláusula última. CLÁUSULA OITAVA - DAS EXCEÇÕES: A\n' +
    'CONTRATADA se reserva o direito de optar por dar férias coletivas a seus funcionários no\n' +
    'período que antecede o Natal e o Dia de Ano Novo, subentendo-se que esses dias não\n' +
    'serão contados como dias úteis para cumprimento das cláusulas deste contrato. A contratada\n' +
    'declara ser uma empresa brasileira com sede em Curitiba - PR e portanto sujeita as leis e\n' +
    'normas vigentes no país e na região onde está instalada, portanto a contratada não poderá ser\n' +
    'penalizada caso por força de lei, projetos de governo e outras forças superiores a sua alçada,\n' +
    'for impedida de concretizar as cláusulas deste contrato.\n';

  page.drawText(initialText, {
    font: normalFont,
    size: fontRemStandard,
    y: topBound - 60,
    x: leftBound,
    lineHeight,
  });

  page.drawText(phoneText, {
    x: leftBound,
    y: topBound - 108,
    font: normalFont,
    size: fontRemStandard,
  });
  page.drawText(addressText, {
    x: leftBound,
    y: topBound - 124,
    font: normalFont,
    size: fontRemStandard,
  });
  page.drawText(numberText, {
    x: leftBound,
    y: topBound - 140,
    font: normalFont,
    size: fontRemStandard,
  });

  page.drawText(bodyTextPage1, {
    font: normalFont,
    size: fontRemStandard,
    y: topBound - 155,
    x: leftBound,
    lineHeight,
  });

  pages.push(page);

  page = pdfDoc.addPage([595, 842]);

  page.drawText(bodyTextPage2, {
    font: normalFont,
    size: fontRemStandard,
    y: topBound,
    x: leftBound,
    lineHeight,
  });

  const cleanedComments = order.comments?.replace(/\r?\n|\r/g, '');

  const lasClause = `CLÁUSULA ULTIMA: ${cleanedComments || ''}`;

  const lastClauseMaxWidth = 550;
  page.drawText(lasClause, {
    font: normalFont,
    size: fontRemStandard,
    y: topBound - 390,
    x: leftBound,
    maxWidth: lastClauseMaxWidth,
    lineHeight,
  });
  const deliveryTime = order.deliveryTime
    ? `${order.deliveryTime.toString()} dias úteis após a medição definitiva e`
    : '';

  const paymentConditions = `condições de pagamento ${order.payment?.conditions || ''
    }`;

  const lastClauseWidth = normalFont.widthOfTextAtSize(
    lasClause,
    fontRemStandard,
  );

  const lastClauseHeight =
    Math.round(lastClauseWidth / lastClauseMaxWidth) * lineHeight;

  let yPositionOfDeliveryTime =
    topBound - (390 + lastClauseHeight + lineHeight);

  if (yPositionOfDeliveryTime <= 40) {
    page = pdfDoc.addPage([595, 842]);
    pages.push(page);
    yPositionOfDeliveryTime = topBound;
  }

  page.drawText(`Prazo de entrega: ${deliveryTime} ${paymentConditions}`, {
    font: normalFont,
    // y: topBound - 405,
    y: yPositionOfDeliveryTime,
    x: leftBound,
    size: fontRemStandard,
    maxWidth: 550,
    lineHeight,
  });

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
      // y: topBound - 450,
      y: yPositionOfDeliveryTime - 45,
      width: 60,
      height: 25,
    });
    increaseX += 80;
  }

  const yPositionOfItensTableHeader = yPositionOfDeliveryTime - 45 - 20;

  // Drawing itens table header
  page.drawRectangle({
    x: leftBound,
    // y: 330,
    y: yPositionOfItensTableHeader,
    width: rightBound - leftBound,
    height: 15,
    color: rgb(0.921, 0.443, 0.203),
  });

  const xQTDE = leftBound + 5;
  const xQTDELine =
    xQTDE + boldFont.widthOfTextAtSize('Qtde', fontRemSmaller) + 10;
  page.drawText('Qtde', {
    x: xQTDE,
    y: yPositionOfItensTableHeader + 5,
    // y: 335,
    size: fontRemSmaller,
    color: rgb(1, 1, 1),
    font: boldFont,
  });
  page.drawLine({
    // start: { x: xQTDELine, y: 331 },
    start: { x: xQTDELine, y: yPositionOfItensTableHeader + 1 },
    // end: { x: xQTDELine, y: 344 },
    end: { x: xQTDELine, y: yPositionOfItensTableHeader + 14 },
    color: rgb(1, 1, 1),
    thickness: 1,
  });

  const xUnid = xQTDELine + 10;
  const xUnidLine =
    xUnid + boldFont.widthOfTextAtSize('Unid', fontRemSmaller) + 10;
  page.drawText('Unid', {
    x: xUnid,
    // y: 335,
    y: yPositionOfItensTableHeader + 5,
    size: fontRemSmaller,
    color: rgb(1, 1, 1),
    font: boldFont,
  });
  page.drawLine({
    // start: { x: xUnidLine, y: 331 },
    start: { x: xUnidLine, y: yPositionOfItensTableHeader + 1 },
    // end: { x: xUnidLine, y: 344 },
    end: { x: xUnidLine, y: yPositionOfItensTableHeader + 14 },
    color: rgb(1, 1, 1),
    thickness: 1,
  });

  const xDesc = xUnidLine + 10;
  const xDescLine =
    xUnid +
    boldFont.widthOfTextAtSize('Descrição dos Materiais', fontRemSmaller) +
    300;
  page.drawText('Descrição dos Materiais', {
    x: xDesc,
    // y: 335,
    y: yPositionOfItensTableHeader + 5,
    size: fontRemSmaller,
    color: rgb(1, 1, 1),
    font: boldFont,
  });
  page.drawLine({
    start: { x: xDescLine, y: yPositionOfItensTableHeader + 1 },
    // start: { x: xDescLine, y: 331 },
    // end: { x: xDescLine, y: 344 },
    end: { x: xDescLine, y: yPositionOfItensTableHeader + 14 },
    color: rgb(1, 1, 1),
    thickness: 1,
  });

  const xPrice = xDescLine + 10;
  const xPriceLine =
    xPrice + boldFont.widthOfTextAtSize('Preço Unit.', fontRemSmaller) + 10;
  page.drawText('Preço Unit.', {
    x: xPrice,
    // y: 335,
    y: yPositionOfItensTableHeader + 5,
    size: fontRemSmaller,
    color: rgb(1, 1, 1),
    font: boldFont,
  });
  page.drawLine({
    // start: { x: xPriceLine, y: 331 },
    start: { x: xPriceLine, y: yPositionOfItensTableHeader + 1 },
    // end: { x: xPriceLine, y: 344 },
    end: { x: xPriceLine, y: yPositionOfItensTableHeader + 14 },
    color: rgb(1, 1, 1),
    thickness: 1,
  });

  const xTotal = xPriceLine + 15;
  page.drawText('TOTAL', {
    x: xTotal,
    y: yPositionOfItensTableHeader + 5,
    // y: 335,
    size: 8,
    color: rgb(1, 1, 1),
    font: boldFont,
  });

  // Drawing table lines
  // let lineY = 300;
  let lineY = yPositionOfItensTableHeader - 30;

  pages.push(page);

  order.items.forEach(item => {
    drawTableLine(page, item, boldFont, lineY);
    lineY -= 30;

    if (lineY <= 40) {
      page = pdfDoc.addPage([595, 842]);
      pages.push(page);
      lineY = topBound;
    }
  });

  if (lineY <= 100) {
    page = pdfDoc.addPage([595, 842]);
    pages.push(page);
    lineY = topBound;
  }

  // sum all itens price
  const subtotal = order.items.reduce((acc, cur) => acc + cur.price, 0);

  // sum all itens discount
  const discount = order.discountTotal || 0;

  const subFormatted = formatCurrency(subtotal / 100);
  const discountFormatted = formatCurrency(discount / 100);
  const totalFormatted = formatCurrency(order.total / 100);

  page.drawText(`Sub-Total: ${subFormatted}`, {
    x: leftBound,
    font: boldFont,
    y: lineY + 5,
    size: fontRemStandard,
  });
  const subTotalSize = boldFont.widthOfTextAtSize(
    `Sub-Total: ${subFormatted}`,
    fontRemStandard,
  );
  page.drawText(`Desconto: ${discountFormatted}`, {
    x: leftBound + subTotalSize + 30,
    font: boldFont,
    y: lineY + 5,
    size: fontRemStandard,
  });
  const discountSize = boldFont.widthOfTextAtSize(
    `Desconto: ${discountFormatted}`,
    fontRemStandard,
  );
  page.drawText(`Total: ${totalFormatted}`, {
    x: leftBound + subTotalSize + 30 + discountSize + 30,
    font: boldFont,
    y: lineY + 5,
    size: fontRemStandard,
  });

  page.drawText(
    `Curitiba ${format(new Date(), "EEEE',' dd 'de' LLLL 'de' yyyy", {
      locale: ptBR,
    })}`,
    { font: normalFont, size: fontRemStandard, y: lineY - 20, x: leftBound },
  );

  page.drawLine({
    start: { x: leftBound, y: lineY - 70 },
    end: { x: leftBound + 250, y: lineY - 70 },
    color: rgb(0, 0, 0),
    thickness: 1,
  });
  page.drawText(`Contratante: ${clientNameCleaned || client.primaryPhone}`, {
    font: normalFont,
    x: leftBound,
    y: lineY - 82,
    size: fontRemSmaller,
  });

  page.drawLine({
    start: { x: rightBound, y: lineY - 70 },
    end: { x: rightBound - 250, y: lineY - 70 },
    color: rgb(0, 0, 0),
    thickness: 1,
  });
  const employeeName = sellerEmployee.name;

  const nameSize = normalFont.widthOfTextAtSize(
    `Contratado: ${employeeName}`,
    fontRemSmaller,
  );
  page.drawText(`Contratado: ${employeeName}`, {
    font: normalFont,
    x: rightBound - nameSize,
    y: lineY - 82,
    size: fontRemSmaller,
  });

  // Drawing footers

  if (lineY - 82 < 30) {
    page = pdfDoc.addPage([595, 842]);
    pages.push(page);
  }

  const employeeEmail = (sellerEmployee && sellerEmployee.email) || '';

  pages.forEach((pageSaved, pageIndex) => {
    drawFooter(
      pageSaved,
      boldFont,
      pages.length,
      pageIndex,
      order.code,
      employeeEmail,
    );
  });

  const pdfBytes = await pdfDoc.save();

  fs.writeFileSync(pdfFilepath, pdfBytes);
}
