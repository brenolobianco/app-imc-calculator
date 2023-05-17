const ListProductsType = `
"Resposta da query que lista produtos."
type ListProducts {
  "Lista de produtos"
  products: [Product]
  "Total de documentos encontrados"
  total: Int
  "Quantidade de páginas"
  pages: Int
  """
  | internalCode | statusCode | message/Descrição                                           |
  | :----------- | :--------: | ----------------------------------------------------------- |
  | 600          |    500     | Erro inesperado. Veja error.internalError e avisar ao back. |
  | 610          |    403     | Token inválido                                              |
  | 611          |    401     | Cabeçalho de autorização inválido                           |
  | 700          |    404     | Usuário não encontrado                                      |
  | 620          |    403     | Este usuário não possui permissão para esta ação            |
  | 630          |    400     | Erro na validação. Veja error.message                       |
  | 740          |    404     | Nenhum produto encontrado                                   |
  """
  error: MyError
}
`;

const listProductsQuery = `
"Lista produtos de forma paginada. APENAS PARA ('dev', 'admin')"
listProducts(
  "Mínimo: 1 caracter. Máximo: 100 caracteres. Procura nos campos ['name']"
  q: String
  "Mínimo 0, Default: 0"
  page: Int
  "Mínimo 1, Default: 5"
  perPage: Int
  "Válidos: ['-name', 'name', '-createdAt', 'createdAt', 'cost', '-cost'] Default: name"
  sort: String
  "Filtro de produto ativo"
  isActivated: Boolean
  "Filtro de tipo"
  type: ProductType
): ListProducts
`;

export const types = ListProductsType;

export const Query = listProductsQuery;
