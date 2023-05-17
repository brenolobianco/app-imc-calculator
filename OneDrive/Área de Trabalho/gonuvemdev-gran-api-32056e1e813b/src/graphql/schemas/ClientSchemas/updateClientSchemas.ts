const UpdateClientInput = `
"Parâmetros para atualizar um cliente. Pelo menos um dos campos opcionais deve ser enviado."
input UpdateClientInput {
  "Nome. Mínimo: 1 caracter"
  name: String
  "Endereço"
  address: AddressInput
  "Telefone principal. String com 10 ou 11 dígitos"
  primaryPhone: String
  "Telefones secundários. Array de String com 10 ou 11 dígitos"
  secondaryPhones: [String]
  "E-mail. Formato de email válido"
  email: String
  "Tipo. Valores válidos ['PF', 'PJ']. Default: 'PF'"
  type: String
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

const UpdateClientType = `
"Resposta da mutation que atualiza um cliente"
type UpdateClient {
  "Cliente atualizado"
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
  | 751          |    404     | Cliente não encontrado                                      |
  | 752          |    409     | Já existe um cliente com este telefone principal            |
  """
  error: MyError
}
`;

const updateClientMutation = `
"Mutation que atualiza um cliente. APENAS PARA ('dev', 'admin')"
updateClient(
  "Regex: /^[0-9a-fA-F]{24}$/"
  id: ID!,
  input: UpdateClientInput!
): UpdateClient!
`;

export const types = UpdateClientType;

export const inputs = UpdateClientInput;

export const Mutation = updateClientMutation;
