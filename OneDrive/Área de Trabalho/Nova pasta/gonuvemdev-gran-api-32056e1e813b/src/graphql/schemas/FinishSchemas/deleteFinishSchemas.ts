const DeleteFinishType = `
"Resposta da mutation que deleta um acabamento"
type DeleteFinish {
  """
  | internalCode | statusCode | message/Descrição                                                         |
  | :----------- | :--------: | ------------------------------------------------------------------------- |
  | 600          |    500     | Erro inesperado. Veja error.internalError e avisar ao back.               |
  | 610          |    403     | Token inválido                                                            |
  | 611          |    401     | Cabeçalho de autorização inválido                                         |
  | 700          |    404     | Usuário não encontrado                                                    |
  | 620          |    403     | Este usuário não possui permissão para esta ação                          |
  | 630          |    400     | Erro na validação. Veja error.message                                     |
  | 731          |    404     | Acabamento não encontrado                                                 |
  | 733          |    422     | Esse acabamento não pode ser deletado pois está em uso por outros objetos |
  """
  error: MyError
}
`;

const deleteFinishMutation = `
"Deleta um acabamento. APENAS PARA ('dev', 'admin')"
deleteFinish(id: ID!): DeleteFinish!
`;

export const types = DeleteFinishType;

export const Mutation = deleteFinishMutation;
