import { Router } from 'express';

import budgetsRouter from './BudgetRoutes';
import agreementsRouter from './AgreementRoutes';

const routes = Router();

routes.use('/budgets', budgetsRouter);

routes.use('/agreements', agreementsRouter);

export default routes;
