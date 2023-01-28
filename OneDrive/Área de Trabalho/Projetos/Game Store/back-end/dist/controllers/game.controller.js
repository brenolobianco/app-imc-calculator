"use strict";
var __awaiter = (this && this.__awaiter) || function (thisArg, _arguments, P, generator) {
    function adopt(value) { return value instanceof P ? value : new P(function (resolve) { resolve(value); }); }
    return new (P || (P = Promise))(function (resolve, reject) {
        function fulfilled(value) { try { step(generator.next(value)); } catch (e) { reject(e); } }
        function rejected(value) { try { step(generator["throw"](value)); } catch (e) { reject(e); } }
        function step(result) { result.done ? resolve(result.value) : adopt(result.value).then(fulfilled, rejected); }
        step((generator = generator.apply(thisArg, _arguments || [])).next());
    });
};
var __importDefault = (this && this.__importDefault) || function (mod) {
    return (mod && mod.__esModule) ? mod : { "default": mod };
};
Object.defineProperty(exports, "__esModule", { value: true });
exports.listGamesController = exports.createGameController = void 0;
const createGame_service_1 = __importDefault(require("../services/games/createGame.service"));
const listGames_service_1 = require("../services/games/listGames.service");
const createGameController = (req, res) => __awaiter(void 0, void 0, void 0, function* () {
    const gameData = req.body;
    const newGame = yield (0, createGame_service_1.default)(gameData);
    return res.status(201).json(newGame);
});
exports.createGameController = createGameController;
const listGamesController = (req, res) => __awaiter(void 0, void 0, void 0, function* () {
    const games = yield (0, listGames_service_1.listGamesService)();
    return res.status(200).json(games);
});
exports.listGamesController = listGamesController;
//# sourceMappingURL=game.controller.js.map