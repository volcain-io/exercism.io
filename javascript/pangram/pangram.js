export function isPangram(input = '') {
  return new Set(input.toLowerCase().replace(/[^a-z]/g, '').split('')).size === 26;
}
