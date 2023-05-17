const ListOrdersType = `
"Resposta da query que lista pedidos."
type ListOrders {
  "Lista de pedidos"
  orders: [Order]
  "Total de documentos encontrados"
  total: Int
  "Quantidade de páginas"
  pages: Int
  """
  | internalCode | statusCode | message/Descrição                                           |
  | :----------- | :--------: | ----------------------------------------------------------- |
  | 600          |    500     | Erro inesperado. Veja error.internalError e avisar ao back. |
  | 610          |    403     | Token inválido                                              |
  | 611          |    401     | Cabeçalho de autorização inválido                           |
  | 700          |    404     | Usuário não encontrado                                      |
  | 620          |    403     | Este usuário não possui permissão para esta ação            |
  | 630          |    400     | Erro na validação. Veja error.message                       |
  | 760          |    404     | Nenhum pedido encontrado                                   |
  """
  error: MyError
}
`;

const listOrdersQuery = `
"Lista pedidos de forma paginada. APENAS PARA ('dev', 'admin')"
listOrders(
  "Mínimo: 1 caracter. Máximo: 100 caracteres. Procura nos campos ['code']"
  q: String
  "Mínimo 0, Default: 0"
  page: Int
  "Mínimo 1, Default: 5"
  perPage: Int
  "Válidos: ['code', '-code', 'date', '-date'] Default: '-code'"
  sort: String
  "Filtro de Cliente"
  client: ID
  "Filtro de Funcionário vendedor. ID de Admin."
  seller: ID
  "Filtro de Funcionário intermediário. ID de Employee."
  intermediator: ID
  "Filtro de tipo"
  type: String
  "Filtro de status"
  status: OrderStatus
  "Filtro de status do pagamento"
  paymentPaid: Boolean
): ListOrders
`;

export const types = ListOrdersType;

export const Query = listOrdersQuery;
