/** Status do Pedido */
export enum OrderStatus {
  /** Em Aberto */
  Opened = 'opened',
  /** Medição */
  Measurement = 'measurement',
  /** Liberação */
  Release = 'release',
  /** Montagem */
  Assembly = 'assembly',
  /** Fechado */
  Closed = 'closed',
}
