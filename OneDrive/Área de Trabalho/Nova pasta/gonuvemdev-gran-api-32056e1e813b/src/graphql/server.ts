import { ApolloServer, IResolvers } from 'apollo-server-express';

import typeDefs from './schemas';
import resolvers from './resolvers';
import { IS_PRODUCTION } from '../utils/constants';
import { getProductPricesPerFinishesDataLoader } from '../helpers/ProductHelpers';
import { getOrderItemsDataLoader } from '../helpers/OrderHelpers';
import { getClientOrdersDataLoader } from '../helpers/ClientHelpers';
import { getEventEmployeesDataLoader } from '../helpers/EventHelpers';

const gqlServer = new ApolloServer({
  typeDefs,
  resolvers: resolvers as IResolvers,
  context: ({ req, res }): unknown => ({
    req,
    res,
    loaders: {
      pricesPerFinishesLoader: getProductPricesPerFinishesDataLoader(),
      orderItemsDataLoader: getOrderItemsDataLoader(),
      clientOrdersDataLoader: getClientOrdersDataLoader(),
      eventEmployeesDataLoader: getEventEmployeesDataLoader(),
    },
  }),
  playground: IS_PRODUCTION === false,
  introspection: IS_PRODUCTION === false,
});

export default gqlServer;
