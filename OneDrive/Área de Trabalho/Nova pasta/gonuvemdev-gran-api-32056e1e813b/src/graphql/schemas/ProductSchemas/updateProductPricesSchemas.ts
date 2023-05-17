const UpdateProductPricesInput = `
"Parâmetros para a atualização dos preços dos Produtos"
input UpdateProductPricesInput {
  "Tipo de mudança percentual. Valores válidos: ['increase', 'decrease']"
  percentageChangeType: String!
  "Valor percentual. Mínimo: 0. Ex.: 7500 (75,00%)"
  value: Int!
}
`;

const UpdateProductPricesType = `
"Resposta da mutation que atualiza os preços dos Produtos"
type UpdateProductPrices {
  """
  | internalCode | statusCode | message/Descrição                                           |
  | :----------- | :--------: | ----------------------------------------------------------- |
  | 600          |    500     | Erro inesperado. Veja error.internalError e avisar ao back. |
  | 610          |    403     | Token inválido                                              |
  | 611          |    401     | Cabeçalho de autorização inválido                           |
  | 700          |    404     | Usuário não encontrado                                      |
  | 620          |    403     | Este usuário não possui permissão para esta ação            |
  | 630          |    400     | Erro na validação. Veja error.message                       |
  """
  error: MyError
}
`;

const updateProductPricesMutation = `
"Cria um produto. APENAS PARA ('dev', 'admin')"
updateProductPrices(input: UpdateProductPricesInput!): UpdateProductPrices!
`;

export const types = `
${UpdateProductPricesType}
`;

export const inputs = `
${UpdateProductPricesInput}
`;

export const Mutation = updateProductPricesMutation;
