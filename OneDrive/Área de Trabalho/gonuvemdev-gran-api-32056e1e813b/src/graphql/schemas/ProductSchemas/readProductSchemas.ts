const ReadProductType = `
"Resposta da query que detalha um produto"
type ReadProduct {
  "Produto consultado"
  product: Product
  """
  | internalCode | statusCode | message/Descrição                                           |
  | :----------- | :--------: | ----------------------------------------------------------- |
  | 600          |    500     | Erro inesperado. Veja error.internalError e avisar ao back. |
  | 610          |    403     | Token inválido                                              |
  | 611          |    401     | Cabeçalho de autorização inválido                           |
  | 700          |    404     | Usuário não encontrado                                      |
  | 620          |    403     | Este usuário não possui permissão para esta ação            |
  | 630          |    400     | Erro na validação. Veja error.message                       |
  | 741          |    404     | Produto não encontrado                                      |
  """
  error: MyError
}
`;

const readProductQuery = `
"Detalha um produto. APENAS PARA ('dev', 'admin')"
readProduct(
  "Regex: /^[0-9a-fA-F]{24}$/"
  id: ID!
): ReadProduct
`;

export const types = ReadProductType;

export const Query = readProductQuery;
