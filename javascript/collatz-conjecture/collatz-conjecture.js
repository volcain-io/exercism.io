export function steps(num) {
  if (num <= 0) throw new Error('Only positive numbers are allowed');

  let count = 0;

  while (num > 1) {
    num = num % 2 ? 3 * num + 1 : num / 2;
    count++;
  }

  return count;
}
