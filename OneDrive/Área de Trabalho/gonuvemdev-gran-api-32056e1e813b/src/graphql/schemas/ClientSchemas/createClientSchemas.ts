const ClientType = `
"Cliente"
type Client {
  "Id"
  _id: ID!
  "Nome"
  name: String
  "Endereço"
  address: Address
  "Telefone principal"
  primaryPhone: String!
  "Telefones secundários"
  secondaryPhones: [String]
  "E-mail"
  email: String
  "Tipo. Valores válidos ['PF', 'PJ']"
  type: String!
  "CPF"
  cpf: String
  "CNPJ"
  cnpj: String
  "RG"
  rg: String
  "Inscrição Estadual"
  stateRegistration: String
  "Administrador que realizou o cadastro deste Cliente"
  adminWhoRegistered: Admin
  "Pedidos deste Cliente ordenados descrescentemente pelo código"
  orders: [Order!]
  "Data de criação"
  createdAt: Date!
  "Data de atualização"
  updatedAt: Date!
}`;

const CreateClientInput = `
"Parâmetros para cadastro de cliente"
input CreateClientInput {
  "Nome. Mínimo: 1 caracter"
  name: String
  "Endereço"
  address: AddressInput
  "Telefone principal. String com 10 ou 11 dígitos"
  primaryPhone: String!
  "Telefones secundários. Array de String com 10 ou 11 dígitos"
  secondaryPhones: [String]
  "E-mail. Formato de email válido"
  email: String
  "Tipo. Valores válidos ['PF', 'PJ']. Default: 'PF'"
  type: String!
  "CPF. String com 11 dígitos"
  cpf: String
  "CNPJ. String com 14 dígitos"
  cnpj: String
  "RG. Apenas dígitos. Mínimo: 1 caracter"
  rg: String
  "Inscrição Estadual. String com 9 dígitos"
  stateRegistration: String
}
`;

const CreateClientType = `
"Resposta da mutation que cria um cliente"
type CreateClient {
  "Cliente criado"
  client: Client
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
  | 752          |    409     | Já existe um cliente com este telefone principal            |
  """
  error: MyError
}`;

const createClientMutation = `
"Cria um cliente. APENAS PARA ('dev', 'admin')"
createClient(input: CreateClientInput!): CreateClient!`;

export const types = `
${ClientType}
${CreateClientType}
`;

export const inputs = `
${CreateClientInput}
`;

export const Mutation = createClientMutation;
