import { Role } from '../../enums';
import {
  UserInterface,
  UserDocument,
  AdminInterface,
  AdminDocument,
  EmployeeDoc,
} from '../../interfaces';

export const checkUser = (
  expected: UserInterface,
  received: Partial<UserDocument>,
): void => {
  expect(received).toMatchObject({
    name: expected.name,
    email: expected.email,
  });

  if (received.roles) {
    received.roles.forEach((role: Role, i: number): void => {
      expect(role).toBe(expected.roles[i]);
    });
  }
};

export const checkAdmin = (
  expected: Required<AdminInterface>,
  received: Partial<AdminDocument>,
): void => {
  checkUser(expected.user as UserInterface, received.user as UserInterface);
  if (received.employee) {
    expect((received.employee as EmployeeDoc)._id.toString()).toBe(
      (expected.employee as EmployeeDoc)._id.toString(),
    );
  }
};
