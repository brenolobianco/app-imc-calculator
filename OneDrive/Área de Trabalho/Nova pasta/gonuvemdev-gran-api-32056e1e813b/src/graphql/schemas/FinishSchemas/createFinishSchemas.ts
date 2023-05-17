const FinishType = `
"Acabamento"
type Finish {
  "Id"
  _id: ID!
  "Código único"
  code: String!
  "Valor. Multiplicador da matéria prima. Fator de escala 100"
  value: Int!
  "Desenho. Url da imagem"
  design: String
  "Engrosso na profundidade em centímetros"
  thickeningInDepth: Int!
  "Engrosso no comprimento em centímetros"
  thickeningInLength: Int!
  "Data de criação"
  createdAt: Date!
  "Data de atualização"
  updatedAt: Date!
}
`;

const CreateFinishInput = `
"Parâmetros para cadastro de acabamento"
input CreateFinishInput {
  "Código único. Mínimo: 1 caracter"
  code: String!
  "Valor. Multiplicador da matéria prima. Fator de escala 100. Mínimo: 100"
  value: Int!
  "Desenho. Url da imagem. Formato de url válida"
  design: String
  "Engrosso na profundidade em centímetros. Mínimo: 0"
  thickeningInDepth: Int!
  "Engrosso no comprimento em centímetros. Mínimo: 0"
  thickeningInLength: Int!
}
`;

const CreateFinishType = `
"Resposta da mutation que cria um acabamento"
type CreateFinish {
  "Acabamento criado"
  finish: Finish
  """
  | internalCode | statusCode | message/Descrição                                           |
  | :----------- | :--------: | ----------------------------------------------------------- |
  | 600          |    500     | Erro inesperado. Veja error.internalError e avisar ao back. |
  | 610          |    403     | Token inválido                                              |
  | 611          |    401     | Cabeçalho de autorização inválido                           |
  | 700          |    404     | Usuário não encontrado                                      |
  | 620          |    403     | Este usuário não possui permissão para esta ação            |
  | 630          |    400     | Erro na validação. Veja error.message                       |
  | 732          |    409     | Já existe um acabamento com este código                     |
  """
  error: MyError
}
`;

const createFinishMutation = `
"Cria um acabamento. APENAS PARA ('dev', 'admin')"
createFinish(input: CreateFinishInput!): CreateFinish!
`;

export const types = `
${FinishType}
${CreateFinishType}
`;

export const inputs = `
${CreateFinishInput}
`;

export const Mutation = createFinishMutation;
