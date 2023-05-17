const ReadOrderType = `
"Resposta da query que detalha um pedido"
type ReadOrder {
  "Pedido consultado"
  order: Order
  """
  | internalCode | statusCode | message/Descrição                                           |
  | :----------- | :--------: | ----------------------------------------------------------- |
  | 600          |    500     | Erro inesperado. Veja error.internalError e avisar ao back. |
  | 610          |    403     | Token inválido                                              |
  | 611          |    401     | Cabeçalho de autorização inválido                           |
  | 700          |    404     | Usuário não encontrado                                      |
  | 620          |    403     | Este usuário não possui permissão para esta ação            |
  | 630          |    400     | Erro na validação. Veja error.message                       |
  | 761          |    404     | Pedido não encontrado                                       |
  """
  error: MyError
}
`;

const readOrderQuery = `
"Detalha um pedido. APENAS PARA ('dev', 'admin')"
readOrder(
  "Regex: /^[0-9a-fA-F]{24}$/"
  id: ID!
): ReadOrder
`;

export const types = ReadOrderType;

export const Query = readOrderQuery;
