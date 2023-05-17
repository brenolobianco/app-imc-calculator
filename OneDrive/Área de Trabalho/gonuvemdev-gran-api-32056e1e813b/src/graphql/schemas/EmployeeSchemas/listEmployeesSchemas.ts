const ListEmployeesType = `
"Resposta da query que lista funcionários."
type ListEmployees {
  "Lista de funcionários"
  employees: [Employee]
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
  | 720          |    404     | Nenhum funcionário encontrado                               |
  """
  error: MyError
}
`;

const listEmployeesQuery = `
"Lista funcionários de forma paginada. APENAS PARA ('dev', 'admin')"
listEmployees(
  "Mínimo: 1 caracter. Máximo: 100 caracteres. Procura nos campos ['name', 'cpf']"
  q: String
  "Mínimo 0, Default: 0"
  page: Int
  "Mínimo 1, Default: 5"
  perPage: Int
  "Válidos: ['-createdAt', 'createdAt', 'name', '-name'] Default: name"
  sort: String
  "Filtro de cargo"
  occupation: String
): ListEmployees
`;

export const types = ListEmployeesType;

export const Query = listEmployeesQuery;
