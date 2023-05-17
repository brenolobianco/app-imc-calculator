const ReadAdminType = `
"Resposta da query que detalha um administrador"
type ReadAdmin {
  "Administrador consultado"
  admin: Admin
  """
  | internalCode | statusCode | message/Descrição                                           |
  | :----------- | :--------: | ----------------------------------------------------------- |
  | 600          |    500     | Erro inesperado. Veja error.internalError e avisar ao back. |
  | 610          |    403     | Token inválido                                              |
  | 611          |    401     | Cabeçalho de autorização inválido                           |
  | 700          |    404     | Usuário não encontrado                                      |
  | 620          |    403     | Este usuário não possui permissão para esta ação            |
  | 630          |    400     | Erro na validação. Veja error.message                       |
  | 711          |    404     | Administrador não encontrado                                |
  """
  error: MyError
}
`;

const readAdminQuery = `
"Detalha um administrador. APENAS PARA ('dev', 'admin')"
readAdmin(
  "Regex: /^[0-9a-fA-F]{24}$/"
  id: ID!
): ReadAdmin!
`;

export const types = ReadAdminType;

export const Query = readAdminQuery;
