const UpdateOrderInput = `
"Parâmetros para atualizar um pedido. Pelo menos um dos campos opcionais deve ser enviado."
input UpdateOrderInput {
  "Tipo. Informa se é Pedido ou Orçamento. Valores válidos ['budget', 'order']. Default: 'budget'"
  type: String
  "Status"
  status: OrderStatus
  "Informações do Pagamento"
  payment: OrderPaymentInput
  "Data do agendamento da montagem. Date em ISOString"
  assemblySchedulingDate: Date
  "Data da montagem do móvel. Date em ISOString"
  furnitureAssemblyDate: Date
  "Observações. Mínimo: 1 caracter"
  comments: String
  "Url da imagem da Nota Fiscal Eletrônica. Formato de url válido."
  nfe: String
  "Urls das imagens da Ordem de Serviço. Formato de url válido."
  serviceOrder: [String]
  "Lista dos arquivos da planta baixa."
  blueprint: [OrderBlueprintInput!]
  "Itens"
  items: [OrderItemInput!]
  "Total do Pedido em centavos. Mínimo: 0"
  total: Int
  "Data de previsão da entrega. Date em ISOString"
  expectedDeliveryDate: Date
  "Data de validade do orçamento. Date em ISOString"
  budgetExpiryDate: Date
  "Cliente. Regex: /^[0-9a-fA-F]{24}$/"
  client: ID
  "Comissão do vendedor. Valor entre 0 (0,00%) e 10000 (100,00%)."
  sellerCommission: Int
  "Funcionário intermediário. Regex: /^[0-9a-fA-F]{24}$/"
  intermediator: ID
  "Comissão do intermediário. Valor entre 0 (0,00%) e 10000 (100,00%)."
  intermediatorCommission: Int
  "Data. Date em ISOString"
  date: Date
  "Dias úteis até a entrega. Mínimo: 0"
  deliveryTime: Int
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

const UpdateOrderType = `
"Resposta da mutation que atualiza um pedido"
type UpdateOrder {
  "Pedido atualizado"
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
  | 761          |    404     | Pedido não encontrado                                       |
  """
  error: MyError
}
`;

const updateOrderMutation = `
"Mutation que atualiza um pedido. APENAS PARA ('dev', 'admin')"
updateOrder(
  "Regex: /^[0-9a-fA-F]{24}$/"
  id: ID!,
  input: UpdateOrderInput!
): UpdateOrder!
`;

export const types = UpdateOrderType;

export const inputs = UpdateOrderInput;

export const Mutation = updateOrderMutation;
