const UpdateProductInput = `
"Parâmetros para atualizar um produto. Pelo menos um dos campos opcionais deve ser enviado."
input UpdateProductInput {
  "Nome. Mínimo: 1 caracter"
  name: String
  "Indica se o produto está ativo ou não. Default: true"
  isActivated: Boolean
  "Custo. Valor em centavos. Mínimo: 0"
  cost: Int
  "Tipo"
  type: ProductType
  "Preço em centavos. Mínimo: 0"
  price: Int
  "Lista de Preço por Acabamento"
  pricesPerFinishes: [ProductPricePerFinishInput!]
}
`;

const UpdateProductType = `
"Resposta da mutation que atualiza um produto"
type UpdateProduct {
  "Produto atualizado"
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
  | 731          |    404     | Acabamento não encontrado                                   |
  """
  error: MyError
}
`;

const updateProductMutation = `
"Mutation que atualiza um produto. APENAS PARA ('dev', 'admin')"
updateProduct(
  "Regex: /^[0-9a-fA-F]{24}$/"
  id: ID!,
  input: UpdateProductInput!
): UpdateProduct!
`;

export const types = UpdateProductType;

export const inputs = UpdateProductInput;

export const Mutation = updateProductMutation;
