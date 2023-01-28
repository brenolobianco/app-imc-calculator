"use strict";
Object.defineProperty(exports, "__esModule", { value: true });
exports.handleError = exports.AppError = void 0;
class AppError extends Error {
    constructor(message, statusCode = 400) {
        super();
        this.statusCode = statusCode;
        this.message = message;
    }
}
exports.AppError = AppError;
const handleError = (err, req, res, next) => {
    if (err instanceof AppError) {
        return res.status(err.statusCode).json({ message: err.message });
    }
    return res.status(500).json({ message: "Internal server error" });
};
exports.handleError = handleError;
//# sourceMappingURL=index.js.map