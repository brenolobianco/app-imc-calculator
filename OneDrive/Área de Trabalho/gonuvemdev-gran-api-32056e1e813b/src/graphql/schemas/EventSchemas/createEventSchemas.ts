const EventType = `
"Evento"
type Event {
  "Id"
  _id: ID!
  "Título "
  title: String!
  "Horário inicial"
  beginDate: Date!
  "Horário final"
  endDate: Date
  "Duração em minutos"
  duration: Int
  "Indica se o evento é uma pendência"
  isPending: Boolean
  "Evento pai que originou esse evento"
  sourceEvent: Event
  "Pedido relacionado a esse evento"
  order: Order
  "Cliente relacionado a esse evento"
  client: Client
  "Funcionários relacionados a esse evento"
  employees: [Employee]
  "Cor. Default: '#f4652d'"
  color: String
  "Data de criação"
  createdAt: Date!
  "Data de atualização"
  updatedAt: Date!
}`;

const CreateEventInput = `
"Parâmetros para cadastro de evento"
input CreateEventInput {
  "Título . Mínimo: 1 caracter"
  title: String!
  "Horário inicial. Date em ISOString"
  beginDate: Date!
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
  "Cor. Default: '#f4652d'. Regex: /^#[0-9a-fA-F]{6}$/"
  color: String
}
`;

const CreateEventType = `
"Resposta da mutation que cria um evento"
type CreateEvent {
  "Evento criado"
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
  | 721          |    404     | Funcionário não encontrado                                  |
  | 751          |    404     | Cliente não encontrado                                      |
  | 761          |    404     | Pedido não encontrado                                       |
  | 771          |    404     | Evento não encontrado                                       |
  """
  error: MyError
}`;

const createEventMutation = `
"Cria um evento. APENAS PARA ('dev', 'admin')"
createEvent(input: CreateEventInput!): CreateEvent!`;

export const types = `
${EventType}
${CreateEventType}
`;

export const inputs = `
${CreateEventInput}
`;

export const Mutation = createEventMutation;
