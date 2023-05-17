const ListEventsType = `
"Resposta da query que lista eventos."
type ListEvents {
  "Lista de eventos"
  events: [Event]
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
  | 770          |    404     | Nenhum evento encontrado                                    |
  """
  error: MyError
}
`;

const listEventsQuery = `
"Lista eventos de forma paginada. APENAS PARA ('dev', 'admin')"
listEvents(
  "Mínimo: 1 caracter. Máximo: 100 caracteres. Procura nos campos ['title']"
  q: String
  "Mínimo 0, Default: 0"
  page: Int
  "Mínimo 1, Default: 5"
  perPage: Int
  "Válidos: ['beginDate', '-beginDate'] Default: 'beginDate'"
  sort: String
  "Filtro de intervalo de data para o campo 'beginDate'"
  dateInterval: DateIntervalInput
  "Filtro de pendência"
  isPending: Boolean
  "Filtro de Pedido"
  order: ID
  "Filtro de Cliente"
  client: ID
  "Filtro de Funcionário"
  employee: ID
): ListEvents
`;

export const types = ListEventsType;

export const Query = listEventsQuery;
