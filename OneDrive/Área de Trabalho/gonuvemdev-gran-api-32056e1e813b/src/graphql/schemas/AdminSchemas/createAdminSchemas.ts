/* eslint-disable no-useless-escape */
const CreateAdminInput = `
"Parâmetros para cadastro de administrador"
input CreateAdminInput {
  "Regex: /^[\w\W]+( [\w\W]+)+$/ -> Pelo menos duas palavras, Máximo: 80 caracteres"
  name: String!,
  "Formato de email válido"
  email: String!,
  "Mínimo: 6 caracteres"
  password: String!
  "Papéis"
  roles: [Role]!
  "Funcionário associado. Regex: /^[0-9a-fA-F]{24}$/"
  employee: ID
}
`;

const CreateAdminType = `
"Resposta da mutation de criar um administrador"
type CreateAdmin {
  "Administrador criado"
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
  | 721          |    404     | Funcionário não encontrado                                  |
  """
  error: MyError
}
`;

const createAdminMutation = `
"Cria um administrador. APENAS PARA ('admin')"
createAdmin(input: CreateAdminInput!): CreateAdmin!
`;

export const types = CreateAdminType;

export const inputs = CreateAdminInput;

export const Mutation = createAdminMutation;
