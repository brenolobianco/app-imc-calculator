import "express-async-errors"
import "reflect-metadata";
import express from "express";
import "reflect-metadata";
import "dotenv/config";
import { handleError } from "./error";
import { GamesRouter } from "./routes/games.routes";

const app = express();
app.use(express.json());
app.use('/games',GamesRouter);

app.use(handleError)

export default app;
