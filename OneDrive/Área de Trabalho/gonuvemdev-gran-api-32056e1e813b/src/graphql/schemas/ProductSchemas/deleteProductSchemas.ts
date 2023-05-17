const DeleteProductType = `
"Resposta da mutation que deleta um produto"
type DeleteProduct {
  """
  | internalCode | statusCode | message/Descrição                                                      |
  | :----------- | :--------: | ---------------------------------------------------------------------- |
  | 600          |    500     | Erro inesperado. Veja error.internalError e avisar ao back.            |
  | 610          |    403     | Token inválido                                                         |
  | 611          |    401     | Cabeçalho de autorização inválido                                      |
  | 700          |    404     | Usuário não encontrado                                                 |
  | 620          |    403     | Este usuário não possui permissão para esta ação                       |
  | 630          |    400     | Erro na validação. Veja error.message                                  |
  | 741          |    404     | Produto não encontrado                                                 |
  | 742          |    422     | Esse produto não pode ser deletado pois está em uso por outros objetos |
  """
  error: MyError
}
`;

const deleteProductMutation = `
"Deleta um produto. APENAS PARA ('dev', 'admin')"
deleteProduct(id: ID!): DeleteProduct!
`;

export const types = DeleteProductType;

export const Mutation = deleteProductMutation;
