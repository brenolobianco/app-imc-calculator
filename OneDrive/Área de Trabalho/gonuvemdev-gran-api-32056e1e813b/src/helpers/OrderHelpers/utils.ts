export function formatCurrency(value: number): string {
  return new Intl.NumberFormat('pt-BR', {
    style: 'currency',
    currency: 'BRL',
  })
    .format(value)
    .replace(',', '#')
    .replace('.', ',')
    .replace('#', '.');
}

export function replaceExtension(
  stringToReplace: string,
  newExtesion: string,
): string {
  const regex = /.[^/.]+$/;

  return stringToReplace.replace(regex, newExtesion);
}
