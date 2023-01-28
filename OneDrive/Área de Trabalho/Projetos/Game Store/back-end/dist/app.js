"use strict";
var __importDefault = (this && this.__importDefault) || function (mod) {
    return (mod && mod.__esModule) ? mod : { "default": mod };
};
Object.defineProperty(exports, "__esModule", { value: true });
require("express-async-errors");
require("reflect-metadata");
const express_1 = __importDefault(require("express"));
require("reflect-metadata");
require("dotenv/config");
const error_1 = require("./error");
const games_routes_1 = require("./routes/games.routes");
const app = (0, express_1.default)();
app.use(express_1.default.json());
app.use('/games', games_routes_1.GamesRouter);
app.use(error_1.handleError);
exports.default = app;
//# sourceMappingURL=app.js.map