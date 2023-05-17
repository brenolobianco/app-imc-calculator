const DeleteAdminType = `
"Resposta da mutation que deleta um administrador"
type DeleteAdmin {
  """
  | internalCode | statusCode | message/Descrição                                                            |
  | :----------- | :--------: | ---------------------------------------------------------------------------- |
  | 600          |    500     | Erro inesperado. Veja error.internalError e avisar ao back.                  |
  | 610          |    403     | Token inválido                                                               |
  | 611          |    401     | Cabeçalho de autorização inválido                                            |
  | 700          |    404     | Usuário não encontrado                                                       |
  | 620          |    403     | Este usuário não possui permissão para esta ação                             |
  | 630          |    400     | Erro na validação. Veja error.message                                        |
  | 711          |    404     | Administrador não encontrado                                                 |
  | 712          |    422     | Esse administrador não pode ser deletado pois está em uso por outros objetos |
  """
  error: MyError
}
`;

const deleteAdminMutation = `
"Deleta um administrador. APENAS PARA ('dev', 'admin')"
deleteAdmin(id: ID!): DeleteAdmin!
`;

export const types = DeleteAdminType;

export const Mutation = deleteAdminMutation;
