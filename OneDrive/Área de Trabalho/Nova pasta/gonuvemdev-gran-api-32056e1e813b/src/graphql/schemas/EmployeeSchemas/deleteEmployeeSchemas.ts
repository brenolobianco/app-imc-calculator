const DeleteEmployeeType = `
"Resposta da mutation que deleta um funcionário"
type DeleteEmployee {
  """
  | internalCode | statusCode | message/Descrição                                                          |
  | :----------- | :--------: | -------------------------------------------------------------------------- |
  | 600          |    500     | Erro inesperado. Veja error.internalError e avisar ao back.                |
  | 610          |    403     | Token inválido                                                             |
  | 611          |    401     | Cabeçalho de autorização inválido                                          |
  | 700          |    404     | Usuário não encontrado                                                     |
  | 620          |    403     | Este usuário não possui permissão para esta ação                           |
  | 630          |    400     | Erro na validação. Veja error.message                                      |
  | 721          |    404     | Funcionário não encontrado                                                 |
  | 722          |    422     | Esse funcionário não pode ser deletado pois está em uso por outros objetos |
  """
  error: MyError
}
`;

const deleteEmployeeMutation = `
"Deleta um funcionário. APENAS PARA ('dev', 'admin')"
deleteEmployee(id: ID!): DeleteEmployee!
`;

export const types = DeleteEmployeeType;

export const Mutation = deleteEmployeeMutation;
