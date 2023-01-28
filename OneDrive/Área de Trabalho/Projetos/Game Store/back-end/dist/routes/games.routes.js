"use strict";
Object.defineProperty(exports, "__esModule", { value: true });
exports.GamesRouter = void 0;
const express_1 = require("express");
const game_controller_1 = require("../controllers/game.controller");
exports.GamesRouter = (0, express_1.Router)();
exports.GamesRouter.post("", game_controller_1.createGameController);
exports.GamesRouter.get("", game_controller_1.listGamesController);
//# sourceMappingURL=games.routes.js.map