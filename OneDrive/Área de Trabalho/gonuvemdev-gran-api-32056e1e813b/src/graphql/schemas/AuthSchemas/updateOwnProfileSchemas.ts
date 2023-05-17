/* eslint-disable no-useless-escape */
const UpdateOwnProfileInput = `
"Parâmetros para atualizar o perfil de um administrador. Pelo menos um dos campos opcionais deve ser enviado."
input UpdateOwnProfileInput {
  "Regex: /^[\w\W]+( [\w\W]+)+$/ -> Pelo menos duas palavras, Máximo: 80 caracteres"
  name: String,
  "Formato de email válido"
  email: String
}
`;

const UpdateOwnProfileType = `
"Resposta da mutation que atualiza o perfil de um administrador"
type UpdateOwnProfile {
  "Perfil atualizado"
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
  | 703          |    409     | Já existe um usuário com este email                         |
  | 721          |    404     | Administrador não encontrado                                |
  """
  error: MyError
}
`;

const updateOwnProfileMutation = `
"Mutation que atualiza o perfil de um administrador. APENAS PARA ('admin')"
updateOwnProfile(input: UpdateOwnProfileInput!): UpdateOwnProfile!
`;

export const inputs = UpdateOwnProfileInput;

export const types = UpdateOwnProfileType;

export const Mutation = updateOwnProfileMutation;
