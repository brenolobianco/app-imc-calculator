import { verifyToken } from '../../middlewares/authentication/authenticationHelper';
import { MyObject, ValidateTokenParams } from '../../types';

export async function validateToken({
  token,
}: ValidateTokenParams): Promise<MyObject> {
  await verifyToken(token);

  return {};
}
