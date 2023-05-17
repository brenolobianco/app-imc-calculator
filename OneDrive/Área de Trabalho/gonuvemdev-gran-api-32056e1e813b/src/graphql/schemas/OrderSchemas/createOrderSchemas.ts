/* eslint-disable max-lines */
const OrderStatusEnum = `
"Status do Pedido"
enum OrderStatus {
  "Em Aberto"
  opened
  "Medição"
  measurement
  "Liberação"
  release
  "Montagem"
  assembly
  "Fechado"
  closed
}`;

const OrderEventType = `
"Evento do Pedido"
type OrderEvent {
  "Status do evento"
  status: OrderStatus!
  "Data do evento"
  date: Date!
  "Descrição do evento"
  description: String
}`;

const PaymentInstallmentType = `
"Parcela de um Pagamento"
type PaymentInstallment {
  "Número da parcela"
  number: Int!
  "Valor da parcela em centavos"
  value: Int!
  "Data de vencimento da parcela"
  expiresAt: Date!
  "Meio de pagamento"
  paymentMethod: String
  "Observações ou informações adicionais"
  comments: String
  "Data de entrada no Caixa"
  incomingDate: Date
}
`;

const OrderPaymentType = `
"Informações do Pagamento do Pedido"
type OrderPayment {
  "Status do pagamento"
  paid: Boolean!
  "Condições de pagamento"
  conditions: String
  "Data do pagamento"
  date: Date
  "Parcelas do pagamento"
  installments: [PaymentInstallment!]
}`;

const OrderItemType = `
"Item do Pedido"
type OrderItem {
  "Quantidade"
  quantity: Int!
  "Descrição"
  description: String!
  "Produto"
  product: Product!
  "Acabamento"
  finish: Finish!
  "Profundidade em centimetros"
  depth: Int!
  "Comprimento em centimetros"
  length: Int!
  "Preço em centavos"
  price: Int!
  "Desconto em centavos"
  discount: Int
  "Acréscimo em centavos"
  addition: Int
  "Percentual do desconto. Valor entre 0 (0,00%) e 10000 (100,00%)."
  discountPercentage: Int
  "Percentual do acréscimo. Valor entre 0 (0,00%) e 10000 (100,00%)."
  additionPercentage: Int
  "Total de metro quadrado do item em centímetros quadrados (1 m2 = 10.000 cm2)"
  m2: Int!
  "Preço unitário em centavos"
  unitPrice: Int!
}`;

const OrderBlueprintType = `
"Planta baixa do Pedido"
type OrderBlueprint {
  "Nome do arquivo da planta baixa"
  name: String!
  "URL de onde está hospedado o arquivo da planta baixa"
  url: String!
}`;

const OrderType = `
"Pedido"
type Order {
  "Id"
  _id: ID!
  "Código sequencial gerado pelo sistema"
  code: String!
  "Cliente"
  client: Client!
  "Vendedor. Administrador logado que criou o Pedido"
  seller: Admin!
  "Comissão do vendedor"
  sellerCommission: Int!
  "Funcionário intermediário"
  intermediator: Employee
  "Comissão do intermediário"
  intermediatorCommission: Int
  "Tipo. Informa se é Pedido ou Orçamento. Valores válidos ['budget', 'order']"
  type: String!
  "Data"
  date: Date!
  "Status"
  status: OrderStatus!
  "Histórico de eventos"
  events: [OrderEvent!]
  "Informações do Pagamento"
  payment: OrderPayment
  "Data de previsão da entrega"
  expectedDeliveryDate: Date
  "Dias úteis até a entrega"
  deliveryTime: Int
  "Data de validade do orçamento"
  budgetExpiryDate: Date
  "Data do agendamento da montagem"
  assemblySchedulingDate: Date
  "Data da montagem do móvel"
  furnitureAssemblyDate: Date
  "Itens"
  items: [OrderItem!]!
  "Observações"
  comments: String
  "Url da imagem da Nota Fiscal Eletrônica"
  nfe: String
  "Urls das imagens da Ordem de Serviço"
  serviceOrder: [String!]
  "Total do Pedido em centavos"
  total: Int!
  "Lista dos arquivos da planta baixa"
  blueprint: [OrderBlueprint!]
  "Desconto total em centavos"
  discountTotal: Int
  "Acréscimo total em centavos"
  additionTotal: Int
  "Percentual do desconto total. Valor entre 0 (0,00%) e 10000 (100,00%)."
  discountTotalPercentage: Int
  "Percentual do acréscimo total. Valor entre 0 (0,00%) e 10000 (100,00%)."
  additionTotalPercentage: Int
  "Data de criação"
  createdAt: Date!
  "Data de atualização"
  updatedAt: Date!
}`;

const OrderEventInput = `
"Parâmetros do objeto de evento do Pedido"
input OrderEventInput {
  "Status do evento"
  status: OrderStatus!
  "Data do evento. Date em ISOString"
  date: Date!
  "Descrição do evento. Mínimo: 1 caracter"
  description: String
} `;

const PaymentInstallmentInput = `
"Parâmetros de uma parcela de um Pagamento"
input PaymentInstallmentInput {
  "Número da parcela. Mínimo: 1"
  number: Int!
  "Valor da parcela em centavos. Mínimo: 0"
  value: Int!
  "Data de vencimento da parcela. Date em ISOString"
  expiresAt: Date!
  "Meio de pagamento. Mínimo: 1 caracter"
  paymentMethod: String
  "Observações ou informações adicionais. Mínimo: 1 caracter"
  comments: String
  "Data de entrada no Caixa. Date em ISOString"
  incomingDate: Date
}`;

const OrderPaymentInput = `
"Parâmetros do objeto de informações do Pagamento do Pedido"
input OrderPaymentInput {
  "Status do pagamento"
  paid: Boolean!
  "Condições de pagamento. Mínimo: 1 caracter"
  conditions: String
  "Data do pagamento. Date em ISOString"
  date: Date
  "Parcelas do pagamento"
  installments: [PaymentInstallmentInput!]
}`;

const OrderItemInput = `
"Parâmetros do objeto de item do Pedido"
input OrderItemInput {
  "Quantidade. Mínimo: 1"
  quantity: Int!
  "Descrição. Mínimo: 1 caracter"
  description: String!
  "Produto. Regex: /^[0-9a-fA-F]{24}$/"
  product: ID!
  "Acabamento. Regex: /^[0-9a-fA-F]{24}$/"
  finish: ID!
  "Profundidade em centimetros. Mínimo: 0"
  depth: Int!
  "Comprimento em centimetros. Mínimo: 0"
  length: Int!
  "Preço em centavos. Mínimo: 0"
  price: Int!
  "Desconto em centavos. Mínimo: 0"
  discount: Int
  "Acréscimo em centavos. Mínimo: 0"
  addition: Int
  "Percentual do desconto. Valor entre 0 (0,00%) e 10000 (100,00%)."
  discountPercentage: Int
  "Percentual do acréscimo. Valor entre 0 (0,00%) e 10000 (100,00%)."
  additionPercentage: Int
  "Total de metro quadrado do item em centímetros quadrados (1 m2 = 10.000 cm2). Mínimo: 0"
  m2: Int!
  "Preço unitário em centavos. Mínimo: 0"
  unitPrice: Int!
} `;

const OrderBlueprintInput = `
"Parâmetros do objeto da planta baixa do Pedido"
input OrderBlueprintInput {
  "Nome do arquivo da planta baixa. Mínimo: 1 caracter"
  name: String!
  "URL de onde está hospedado o arquivo da planta baixa. Formato de url válido."
  url: String!
}`;

const CreateOrderInput = `
"Parâmetros para cadastro de pedido"
input CreateOrderInput {
  "Cliente. Regex: /^[0-9a-fA-F]{24}$/"
  client: ID!
  "Comissão do vendedor. Valor entre 0 (0,00%) e 10000 (100,00%)."
  sellerCommission: Int!
  "Funcionário intermediário. Regex: /^[0-9a-fA-F]{24}$/"
  intermediator: ID
  "Comissão do intermediário. Valor entre 0 (0,00%) e 10000 (100,00%)."
  intermediatorCommission: Int
  "Tipo. Informa se é Pedido ou Orçamento. Valores válidos ['budget', 'order']. Default: 'budget'"
  type: String!
  "Data. Date em ISOString"
  date: Date!
  "Status"
  status: OrderStatus!
  "Histórico de eventos"
  events: [OrderEventInput!]
  "Informações do Pagamento"
  payment: OrderPaymentInput
  "Data de previsão da entrega. Date em ISOString"
  expectedDeliveryDate: Date
  "Dias úteis até a entrega. Mínimo: 0"
  deliveryTime: Int
  "Data de validade do orçamento. Date em ISOString"
  budgetExpiryDate: Date
  "Data do agendamento da montagem. Date em ISOString"
  assemblySchedulingDate: Date
  "Data da montagem do móvel. Date em ISOString"
  furnitureAssemblyDate: Date
  "Itens"
  items: [OrderItemInput!]
  "Observações. Mínimo: 1 caracter"
  comments: String
  "Url da imagem da Nota Fiscal Eletrônica. Formato de url válido."
  nfe: String
  "Urls das imagens da Ordem de Serviço. Formato de url válido."
  serviceOrder: [String]
  "Total do Pedido em centavos. Mínimo: 0"
  total: Int!
  "Lista dos arquivos da planta baixa."
  blueprint: [OrderBlueprintInput!]
  "Desconto total em centavos"
  discountTotal: Int
  "Acréscimo total em centavos"
  additionTotal: Int
  "Percentual do desconto total. Valor entre 0 (0,00%) e 10000 (100,00%)."
  discountTotalPercentage: Int
  "Percentual do acréscimo total. Valor entre 0 (0,00%) e 10000 (100,00%)."
  additionTotalPercentage: Int
}
`;

const CreateOrderType = `
"Resposta da mutation que cria um pedido"
type CreateOrder {
  "Pedido criado"
  order: Order
  """
  | internalCode | statusCode | message/Descrição                                           |
  | :----------- | :--------: | ----------------------------------------------------------- |
  | 600          |    500     | Erro inesperado. Veja error.internalError e avisar ao back. |
  | 610          |    403     | Token inválido                                              |
  | 611          |    401     | Cabeçalho de autorização inválido                           |
  | 700          |    404     | Usuário não encontrado                                      |
  | 620          |    403     | Este usuário não possui permissão para esta ação            |
  | 630          |    400     | Erro na validação. Veja error.message                       |
  | 711          |    404     | Administrador não encontrado                                |
  | 721          |    404     | Funcionário não encontrado                                  |
  | 731          |    404     | Acabamento não encontrado                                   |
  | 741          |    404     | Produto não encontrado                                      |
  | 751          |    404     | Cliente não encontrado                                      |
  """
error: MyError
}`;

const createOrderMutation = `
"Cria um pedido. APENAS PARA ('admin')"
createOrder(input: CreateOrderInput!): CreateOrder!`;

export const enums = OrderStatusEnum;

export const types = `
${OrderEventType}
${PaymentInstallmentType}
${OrderPaymentType}
${OrderItemType}
${OrderBlueprintType}
${OrderType}
${CreateOrderType}
`;

export const inputs = `
${OrderEventInput}
${PaymentInstallmentInput}
${OrderPaymentInput}
${OrderItemInput}
${OrderBlueprintInput}
${CreateOrderInput}
`;

export const Mutation = createOrderMutation;
