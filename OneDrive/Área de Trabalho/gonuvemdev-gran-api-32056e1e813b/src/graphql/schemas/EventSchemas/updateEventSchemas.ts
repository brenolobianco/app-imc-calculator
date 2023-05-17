const UpdateEventInput = `
"Parâmetros para atualizar um evento. Pelo menos um dos campos opcionais deve ser enviado."
input UpdateEventInput {
  "Título . Mínimo: 1 caracter"
  title: String
  "Horário inicial. Date em ISOString"
  beginDate: Date
  "Horário final. Date em ISOString"
  endDate: Date
  "Duração em minutos. Mínimo: 0"
  duration: Int
  "Indica se o evento é uma pendência"
  isPending: Boolean
  "Evento pai que originou esse evento. Regex: /^[0-9a-fA-F]{24}$/"
  sourceEvent: ID
  "Pedido relacionado a esse evento. Regex: /^[0-9a-fA-F]{24}$/"
  order: ID
  "Cliente relacionado a esse evento. Regex: /^[0-9a-fA-F]{24}$/"
  client: ID
  "Funcionários relacionados a esse evento. Mínimo: 1 elemento. Regex: /^[0-9a-fA-F]{24}$/"
  employees: [ID!]
  "Cor. Regex: /^#[0-9a-fA-F]{6}$/"
  color: String
}
`;

const UpdateEventType = `
"Resposta da mutation que atualiza um evento"
type UpdateEvent {
  "Evento atualizado"
  event: Event
  """
  | internalCode | statusCode | message/Descrição                                           |
  | :----------- | :--------: | ----------------------------------------------------------- |
  | 600          |    500     | Erro inesperado. Veja error.internalError e avisar ao back. |
  | 610          |    403     | Token inválido                                              |
  | 611          |    401     | Cabeçalho de autorização inválido                           |
  | 700          |    404     | Usuário não encontrado                                      |
  | 620          |    403     | Este usuário não possui permissão para esta ação            |
  | 630          |    400     | Erro na validação. Veja error.message                       |
  | 771          |    404     | Evento não encontrado                                       |
  """
  error: MyError
}
`;

const updateEventMutation = `
"Mutation que atualiza um evento. APENAS PARA ('dev', 'admin')"
updateEvent(
  "Regex: /^[0-9a-fA-F]{24}$/"
  id: ID!,
  input: UpdateEventInput!
): UpdateEvent!
`;

export const types = UpdateEventType;

export const inputs = UpdateEventInput;

export const Mutation = updateEventMutation;
