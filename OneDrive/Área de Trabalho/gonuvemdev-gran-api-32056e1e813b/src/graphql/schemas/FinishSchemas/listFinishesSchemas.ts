const ListFinishesType = `
"Resposta da query que lista acabamentos."
type ListFinishes {
  "Lista de acabamentos"
  finishes: [Finish]
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
  | 730          |    404     | Nenhum acabamento encontrado                                |
  """
  error: MyError
}
`;

const listFinishesQuery = `
"Lista acabamentos de forma paginada. APENAS PARA ('dev', 'admin')"
listFinishes(
  "Mínimo: 1 caracter. Máximo: 100 caracteres. Procura nos campos ['code']"
  q: String
  "Mínimo 0, Default: 0"
  page: Int
  "Mínimo 1, Default: 5"
  perPage: Int
  "Válidos: ['-createdAt', 'createdAt', 'code', '-code'] Default: code"
  sort: String
): ListFinishes
`;

export const types = ListFinishesType;

export const Query = listFinishesQuery;
