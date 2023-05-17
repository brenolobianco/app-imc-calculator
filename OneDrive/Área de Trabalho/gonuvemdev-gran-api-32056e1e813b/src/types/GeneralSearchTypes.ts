import { ClientDoc, OrderDoc } from '../interfaces';

/** Parâmetros da query que faz uma busca textual nos orçamentos e clientes */
export type GeneralSearchParams = {
  /**
   * Mínimo 3 caracteres. Procura nos campos dos seguintes objetos:
   * order.seller - ['user.name', 'user.email']
   * client e order.client - ['name', 'primaryPhone', 'secondaryPhones']
   * order.intermediator - ['name', 'cpf']
   * order.items.finish - ['code']
   * order.items.product - ['name']
   * order - ['code']
   *  */
  q: string;
};

/** Resposta da query que faz uma busca textual nos orçamentos e clientes */
export type GeneralSearchResponse = {
  /** Orçamentos encontrados. Máximo: 10 */
  budgets: OrderDoc[];
  /** Clientes encontrados. Máximo: 10 */
  clients: ClientDoc[];
};
