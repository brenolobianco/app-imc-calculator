import { CreateFinishInput, UpdateFinishInput } from '../../types';

export function createInputCreateFinish(input: CreateFinishInput): string {
  return `{
    code: "${input.code}",
    value: ${input.value},
    design: "${input.design}",
    thickeningInDepth: ${input.thickeningInDepth},
    thickeningInLength: ${input.thickeningInLength},
  }`;
}

export function createInputUpdateFinish(
  input: Required<UpdateFinishInput>,
): string {
  return createInputCreateFinish(input);
}
