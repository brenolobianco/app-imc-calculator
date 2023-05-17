import { FinishInterface } from '../../interfaces';

export function checkFinish(
  expected: Required<FinishInterface>,
  received: FinishInterface,
): void {
  expect(received).toMatchObject<Required<FinishInterface>>({
    code: expected.code,
    value: expected.value,
    design: expected.design,
    thickeningInDepth: expected.thickeningInDepth,
    thickeningInLength: expected.thickeningInLength,
  });
}
