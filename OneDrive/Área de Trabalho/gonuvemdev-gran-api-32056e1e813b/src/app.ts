import express from 'express';
import cors from 'cors';
import compression from 'compression';
import swaggerUi from 'swagger-ui-express';

import './env';
import './middlewares/errorHandling/sentry';
import { gqlServer, gqlCors } from './graphql';
import handleError from './middlewares/errorHandling';
import logger from './middlewares/logging';
import routes from './routes';
import swaggerDocument from './swagger.json';
import { IS_PRODUCTION } from './utils/constants';

const app = express();

app.use(logger);

app.use(cors());

app.use(compression());

app.use(express.json({ limit: '60mb' }));

app.use(express.urlencoded({ extended: true }));

app.use(routes);

if (!IS_PRODUCTION) {
  app.use('/docs', swaggerUi.serve, swaggerUi.setup(swaggerDocument));
}

app.get('/', (_, res) => {
  return res.json({ message: 'GranParaná API' });
});

gqlServer.applyMiddleware({ app, cors: gqlCors });

app.use(handleError);

export default app;
