const GeneralSearchType = `
"Resposta da query que faz uma busca textual nos orçamentos e clientes"
type GeneralSearch {
  "Orçamentos encontrados. Máximo: 10"
  budgets: [Order!]
  "Clientes encontrados. Máximo: 10"
  clients: [Client!]
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

const generalSearchQuery = `
"Faz uma busca textual nos orçamentos e clientes. APENAS PARA ('dev', 'admin')"
generalSearch(
  """
   * Mínimo 3 caracteres. Máximo: 100 caracteres. Procura nos campos dos seguintes objetos:"
   * order.seller - ['user.name', 'user.email']
   * client e order.client - ['name', 'primaryPhone', 'secondaryPhones']
   * order.intermediator - ['name', 'cpf']
   * order.items.finish - ['code']
   * order.items.product - ['name']
   * order - ['code']
  """
  q: String!
): GeneralSearch
`;

export const types = `
${GeneralSearchType}
`;

export const Query = generalSearchQuery;
