const ReadEmployeeType = `
"Resposta da query que detalha um funcionário"
type ReadEmployee {
  "Funcionário consultado"
  employee: Employee
  """
  | internalCode | statusCode | message/Descrição                                           |
  | :----------- | :--------: | ----------------------------------------------------------- |
  | 600          |    500     | Erro inesperado. Veja error.internalError e avisar ao back. |
  | 610          |    403     | Token inválido                                              |
  | 611          |    401     | Cabeçalho de autorização inválido                           |
  | 700          |    404     | Usuário não encontrado                                      |
  | 620          |    403     | Este usuário não possui permissão para esta ação            |
  | 630          |    400     | Erro na validação. Veja error.message                       |
  | 721          |    404     | Funcionário não encontrado                                  |
  """
  error: MyError
}
`;

const readEmployeeQuery = `
"Detalha um funcionário. APENAS PARA ('dev', 'admin')"
readEmployee(
  "Regex: /^[0-9a-fA-F]{24}$/"
  id: ID!
): ReadEmployee
`;

export const types = ReadEmployeeType;

export const Query = readEmployeeQuery;
