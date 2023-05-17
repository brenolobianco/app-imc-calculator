/* eslint-disable no-useless-escape */
const UpdateAdminInput = `
"Parâmetros para atualizar um administrador. Pelo menos um dos campos opcionais deve ser enviado."
input UpdateAdminInput {
  "Regex: /^[\w\W]+( [\w\W]+)+$/ -> Pelo menos duas palavras, Máximo: 80 caracteres"
  name: String,
  "Formato de email válido"
  email: String
  "Papéis"
  roles: [Role]
  "Funcionário associado. Regex: /^[0-9a-fA-F]{24}$/"
  employee: ID
}
`;

const UpdateAdminType = `
"Resposta da mutation que atualiza um administrador"
type UpdateAdmin {
  "Administrador atualizado"
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
  | 711          |    404     | Administrador não encontrado                                |
  | 721          |    404     | Funcionário não encontrado                                  |
  """
  error: MyError
}
`;

const updateAdminMutation = `
"Mutation que atualiza um administrador. APENAS PARA ('dev', 'admin')"
updateAdmin(
  "Regex: /^[0-9a-fA-F]{24}$/"
  id: ID!,
  input: UpdateAdminInput!
): UpdateAdmin!
`;

export const types = UpdateAdminType;

export const inputs = UpdateAdminInput;

export const Mutation = updateAdminMutation;
