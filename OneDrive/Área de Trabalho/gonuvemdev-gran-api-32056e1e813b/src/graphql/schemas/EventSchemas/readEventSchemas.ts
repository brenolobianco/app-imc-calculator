const ReadEventType = `
"Resposta da query que detalha um evento"
type ReadEvent {
  "Evento consultado"
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

const readEventQuery = `
"Detalha um evento. APENAS PARA ('dev', 'admin')"
readEvent(
  "Regex: /^[0-9a-fA-F]{24}$/"
  id: ID!
): ReadEvent
`;

export const types = ReadEventType;

export const Query = readEventQuery;
