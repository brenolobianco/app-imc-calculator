import { CreateAdminInput, UpdateAdminInput } from '../../types';
import { createArrayInput, createNonStringValue } from '../gqlTestHelper';

export const createInputCreateAdmin = (input: CreateAdminInput): string => `{
  name: "${input.name}",
  email: "${input.email}",
  password: "${input.password}"
  roles: ${createArrayInput(input.roles, createNonStringValue)}
  employee: "${input.employee}"
}`;

export const createInputUpdateAdmin = (input: UpdateAdminInput): string => `{
  name: "${input.name}",
  email: "${input.email}"
  roles: ${createArrayInput(input.roles, createNonStringValue)}
  employee: "${input.employee}"
}`;
