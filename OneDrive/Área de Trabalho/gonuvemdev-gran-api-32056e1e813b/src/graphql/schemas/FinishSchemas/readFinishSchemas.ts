const ReadFinishType = `
"Resposta da query que detalha um acabamento"
type ReadFinish {
  "Acabamento consultado"
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
  """
  error: MyError
}
`;

const readFinishQuery = `
"Detalha um acabamento. APENAS PARA ('dev', 'admin')"
readFinish(
  "Regex: /^[0-9a-fA-F]{24}$/"
  id: ID!
): ReadFinish
`;

export const types = ReadFinishType;

export const Query = readFinishQuery;
