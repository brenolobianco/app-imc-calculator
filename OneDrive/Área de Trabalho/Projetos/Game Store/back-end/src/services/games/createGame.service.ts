import AppDataSource from "../../data-source";
import { Games } from "../../entities/entities";

const createGameService = async (gameData) => {
  const gameRepository = AppDataSource.getRepository(Games);

  const createdGame = gameRepository.create(gameData);
  await gameRepository.save(createdGame);

  return createdGame;
};

export default createGameService;
