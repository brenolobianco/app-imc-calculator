const DeleteEventType = `
"Resposta da mutation que deleta um evento"
type DeleteEvent {
  """
  | internalCode | statusCode | message/Descrição                                                     |
  | :----------- | :--------: | --------------------------------------------------------------------- |
  | 600          |    500     | Erro inesperado. Veja error.internalError e avisar ao back.           |
  | 610          |    403     | Token inválido                                                        |
  | 611          |    401     | Cabeçalho de autorização inválido                                     |
  | 700          |    404     | Usuário não encontrado                                                |
  | 620          |    403     | Este usuário não possui permissão para esta ação                      |
  | 630          |    400     | Erro na validação. Veja error.message                                 |
  | 771          |    404     | Evento não encontrado                                                 |
  | 772          |    422     | Esse evento não pode ser deletado pois está em uso por outros objetos |
  """
  error: MyError
}`;

const deleteEventMutation = `
"Deleta um evento. APENAS PARA ('dev', 'admin')"
deleteEvent(id: ID!): DeleteEvent!`;

export const types = DeleteEventType;

export const Mutation = deleteEventMutation;
