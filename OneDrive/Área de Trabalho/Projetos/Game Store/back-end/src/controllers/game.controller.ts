import { Request, Response } from "express";
import createGameService from "../services/games/createGame.service";
import { listGamesService } from "../services/games/listGames.service";

export const createGameController = async (req: Request, res: Response) => {
  const gameData = req.body;
  const newGame = await createGameService(gameData);
  return res.status(201).json(newGame);
};

export const listGamesController = async (req: Request, res: Response) => {
  const games = await listGamesService();
  return res.status(200).json(games);
};
