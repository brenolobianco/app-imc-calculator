const DeleteOrderType = `
"Resposta da mutation que deleta um pedido"
type DeleteOrder {
  """
  | internalCode | statusCode | message/Descrição                                                     |
  | :----------- | :--------: | --------------------------------------------------------------------- |
  | 600          |    500     | Erro inesperado. Veja error.internalError e avisar ao back.           |
  | 610          |    403     | Token inválido                                                        |
  | 611          |    401     | Cabeçalho de autorização inválido                                     |
  | 700          |    404     | Usuário não encontrado                                                |
  | 620          |    403     | Este usuário não possui permissão para esta ação                      |
  | 630          |    400     | Erro na validação. Veja error.message                                 |
  | 771          |    404     | Pedido não encontrado                                                 |
  """
  error: MyError
}`;

const deleteOrderMutation = `
"Deleta um pedido. APENAS PARA ('dev', 'admin')"
deleteOrder(id: ID!): DeleteOrder!`;

export const types = DeleteOrderType;

export const Mutation = deleteOrderMutation;
