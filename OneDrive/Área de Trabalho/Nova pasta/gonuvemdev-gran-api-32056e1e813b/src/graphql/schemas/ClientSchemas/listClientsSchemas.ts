const ListClientsType = `
"Resposta da query que lista clientes."
type ListClients {
  "Lista de clientes"
  clients: [Client]
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
  | 750          |    404     | Nenhum cliente encontrado                                   |
  """
  error: MyError
}
`;

const listClientsQuery = `
"Lista clientes de forma paginada. APENAS PARA ('dev', 'admin')"
listClients(
  "Mínimo: 1 caracter. Máximo: 100 caracteres. Procura nos campos ['name', 'primaryPhone', 'secondaryPhones']"
  q: String
  "Mínimo 0, Default: 0"
  page: Int
  "Mínimo 1, Default: 5"
  perPage: Int
  "Válidos: ['name', '-name', 'createdAt', '-createdAt'] Default: 'name'"
  sort: String
  "Filtro de tipo. Valores válidos ['PF', 'PJ']"
  type: String
  "Filtro de Administrador"
  adminWhoRegistered: ID
): ListClients
`;

export const types = ListClientsType;

export const Query = listClientsQuery;
