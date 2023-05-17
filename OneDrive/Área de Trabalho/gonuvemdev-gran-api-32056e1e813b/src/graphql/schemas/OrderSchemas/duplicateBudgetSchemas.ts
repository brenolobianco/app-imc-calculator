const DuplicateBudgetType = `
"Resposta da mutation que duplica um orçamento"
type DuplicateBudget {
  "Novo orçamento"
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

const duplicateBudgetMutation = `
"Mutation que duplica um orçamento. APENAS PARA ('dev', 'admin')"
duplicateBudget(
  "Regex: /^[0-9a-fA-F]{24}$/"
  id: ID!
): DuplicateBudget!
`;

export const types = DuplicateBudgetType;

export const Mutation = duplicateBudgetMutation;
