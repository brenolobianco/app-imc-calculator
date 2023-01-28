import { Router } from "express";
import {
  createGameController,
  listGamesController,
} from "../controllers/game.controller";

export const GamesRouter = Router();

GamesRouter.post("",createGameController);
GamesRouter.get("", listGamesController);
