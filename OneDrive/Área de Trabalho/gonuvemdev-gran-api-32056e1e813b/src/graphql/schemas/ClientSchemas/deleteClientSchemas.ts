const DeleteClientType = `
"Resposta da mutation que deleta um cliente"
type DeleteClient {
  """
  | internalCode | statusCode | message/Descrição                                                      |
  | :----------- | :--------: | ---------------------------------------------------------------------- |
  | 600          |    500     | Erro inesperado. Veja error.internalError e avisar ao back.            |
  | 610          |    403     | Token inválido                                                         |
  | 611          |    401     | Cabeçalho de autorização inválido                                      |
  | 700          |    404     | Usuário não encontrado                                                 |
  | 620          |    403     | Este usuário não possui permissão para esta ação                       |
  | 630          |    400     | Erro na validação. Veja error.message                                  |
  | 751          |    404     | Cliente não encontrado                                                 |
  | 753          |    422     | Esse cliente não pode ser deletado pois está em uso por outros objetos |
  """
  error: MyError
}`;

const deleteClientMutation = `
"Deleta um cliente. APENAS PARA ('dev', 'admin')"
deleteClient(id: ID!): DeleteClient!`;

export const types = DeleteClientType;

export const Mutation = deleteClientMutation;
