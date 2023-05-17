const ListAdminsType = `
"Resposta da query que lista administradores."
type ListAdmins {
  "Lista de administradores"
  admins: [Admin]
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
  | 710          |    404     | Nenhum administrador encontrado                             |
  """
  error: MyError
}
`;

const listAdminsQuery = `
"Lista administradores de forma paginada. APENAS PARA ('dev', 'admin')"
listAdmins(
  "Mínimo: 1 caracter. Máximo: 100 caracteres. Campos de busca: ['user.name', 'user.email']"
  q: String
  "Mínimo 0, Default: 0"
  page: Int
  "Mínimo 1, Default: 5"
  perPage: Int
  "Válidos: ['-user.name', 'user.name', '-createdAt', 'createdAt'] Default: user.name"
  sort: String
): ListAdmins!
`;

export const types = ListAdminsType;

export const Query = listAdminsQuery;
