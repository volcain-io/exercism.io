export function isPangram(input = '') {
  return (input.toLowerCase().match(/([a-z])(?!.*\1)/g) || []).length === 26;
}
