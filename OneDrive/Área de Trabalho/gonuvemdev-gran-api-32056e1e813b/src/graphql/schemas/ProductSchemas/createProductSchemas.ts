const ProductTypeEnum = `
"Tipo do Produto"
enum ProductType {
  "Matéria Prima"
  rawMaterial
  "Acessórios"
  accessories
  "Mão-de-obra"
  labor
  "Base para mesa"
  tableBase
  "Outros"
  others
}`;

const ProductPricePerFinishType = `
"Preço do Produto por Acabamento"
type ProductPricePerFinish {
  "Preço em centavos"
  price: Int!
  "Acabamento associado"
  finish: Finish!
}`;

const ProductType = `
"Produto"
type Product {
  "Id"
  _id: ID!
  "Nome"
  name: String!
  "Indica se o produto está ativo ou não"
  isActivated: Boolean!
  "Custo"
  cost: Int!
  "Tipo"
  type: ProductType!
  "Preço em centavos"
  price: Int
  "Lista de Preço por Acabamento"
  pricesPerFinishes: [ProductPricePerFinish]
  "Data de criação"
  createdAt: Date!
  "Data de atualização"
  updatedAt: Date!
}
`;

const ProductPricePerFinishInput = `
"Parâmetros do objeto Preço do Produto por Acabamento"
input ProductPricePerFinishInput {
  "Preço em centavos. Mínimo 0"
  price: Int!
  "Acabamento associado. Regex: /^[0-9a-fA-F]{24}$/"
  finish: ID!
}`;

const CreateProductInput = `
"Parâmetros para cadastro de produto. Pelo menos um dos campos de preço deve ser enviado."
input CreateProductInput {
  "Nome. Mínimo: 1 caracter"
  name: String!
  "Indica se o produto está ativo ou não. Default: true"
  isActivated: Boolean!
  "Custo. Valor em centavos. Mínimo: 0"
  cost: Int!
  "Tipo"
  type: ProductType!
  "Preço em centavos. Mínimo: 0"
  price: Int
  "Lista de Preço por Acabamento"
  pricesPerFinishes: [ProductPricePerFinishInput!]
}
`;

const CreateProductType = `
"Resposta da mutation que cria um produto"
type CreateProduct {
  "Produto criado"
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
  | 731          |    404     | Acabamento não encontrado                                   |
  """
  error: MyError
}
`;

const createProductMutation = `
"Cria um produto. APENAS PARA ('dev', 'admin')"
createProduct(input: CreateProductInput!): CreateProduct!
`;

export const enums = ProductTypeEnum;

export const types = `
${ProductType}
${ProductPricePerFinishType}
${CreateProductType}
`;

export const inputs = `
${ProductPricePerFinishInput}
${CreateProductInput}
`;

export const Mutation = createProductMutation;
