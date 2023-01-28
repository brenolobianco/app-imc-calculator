import AppDataSource from "../../data-source";
import { Games } from "../../entities/entities";

export const listGamesService = async () => {
  const gameRepository = AppDataSource.getRepository(Games);

  const games = await gameRepository.find();

  return games;
};
