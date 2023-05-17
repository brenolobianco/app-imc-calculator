const UpdateFinishInput = `
"Parâmetros para atualizar um acabamento. Pelo menos um dos campos opcionais deve ser enviado."
input UpdateFinishInput {
  "Código único. Mínimo: 1 caracter"
  code: String
  "Valor. Multiplicador da matéria prima. Fator de escala 100. Mínimo: 100"
  value: Int
  "Desenho. Url da imagem. Formato de url válida"
  design: String
  "Engrosso na profundidade em centímetros. Mínimo: 0"
  thickeningInDepth: Int
  "Engrosso no comprimento em centímetros. Mínimo: 0"
  thickeningInLength: Int
}
`;

const UpdateFinishType = `
"Resposta da mutation que atualiza um acabamento"
type UpdateFinish {
  "Acabamento atualizado"
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
  | 731          |    404     | Acabamento não encontrado                                   |
  | 732          |    409     | Já existe um acabamento com este código                     |
  """
  error: MyError
}
`;

const updateFinishMutation = `
"Mutation que atualiza um acabamento. APENAS PARA ('dev', 'admin')"
updateFinish(
  "Regex: /^[0-9a-fA-F]{24}$/"
  id: ID!,
  input: UpdateFinishInput!
): UpdateFinish!
`;

export const types = UpdateFinishType;

export const inputs = UpdateFinishInput;

export const Mutation = updateFinishMutation;
