const ListEmployeesOccupationsType = `
"Resposta da query que lista cargos dos funcionários."
type ListEmployeesOccupations {
  "Lista de cargos. Pode ser vazia []."
  occupations: [String]
  """
  | internalCode | statusCode | message/Descrição                                           |
  | :----------- | :--------: | ----------------------------------------------------------- |
  | 600          |    500     | Erro inesperado. Veja error.internalError e avisar ao back. |
  | 610          |    403     | Token inválido                                              |
  | 611          |    401     | Cabeçalho de autorização inválido                           |
  | 700          |    404     | Usuário não encontrado                                      |
  | 620          |    403     | Este usuário não possui permissão para esta ação            |
  | 720          |    404     | Nenhum funcionário encontrado                               |
  """
  error: MyError
}
`;

const listEmployeesOccupationsQuery = `
"Lista cargos dos funcionários. APENAS PARA ('dev', 'admin')"
listEmployeesOccupations: ListEmployeesOccupations
`;

export const types = ListEmployeesOccupationsType;

export const Query = listEmployeesOccupationsQuery;
