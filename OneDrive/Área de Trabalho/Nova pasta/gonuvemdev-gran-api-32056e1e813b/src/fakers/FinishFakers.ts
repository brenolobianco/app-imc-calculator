import { fakePhoto, fakeRandomInt, fakeWord } from './fakersUtils';
import { FinishInterface } from '../interfaces';
import { Fake } from '../types';

export const fakeFinish: Fake<FinishInterface> = {
  code: () => fakeWord() + fakeWord(),
  value: fakeRandomInt({ min: 100, max: 715 }),
  design: fakePhoto,
  thickeningInDepth: fakeRandomInt({ min: 0, max: 60 }),
  thickeningInLength: fakeRandomInt({ min: 0, max: 60 }),
};
