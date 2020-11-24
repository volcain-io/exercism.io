<?php

/**
 * Get the nth prime number at given position.
 *
 * @param int $pos The nth prime number.
 *
 * @return int The return value as int.
 *
 * @throws RangeException If given $pos is greater than `PHP_INT_MAX`.
 */
function prime(int $pos = 0): int
{
  if ($pos > PHP_INT_MAX)
    throw new RangeException('Number is too big. Maximum allowed num is: ' . PHP_INT_MAX);

  if ($pos < 1)
    return 0;

  return primes($pos)[$pos - 1];
}

/**
 * Create a list of primes by the given number of length.
 *
 * @param int $length Number of primes to create.
 *
 * @return array The list of primes with length $length.
 */
function primes(int $length = 0): array
{
  $output = [];
  $idx = 0;
  while (count($output) < $length) {
    if (isPrimeNumber($idx++))
      $output[] = $idx - 1;
  }
  return $output;
}

/**
 * Check if given number is a prime number.
 *
 * @param int $num The number to check.
 *
 * @return bool `true` on success, `false` on failure.
 *
 * @throws RangeException If given natural number is greater than `PHP_INT_MAX`.
 */
function isPrimeNumber(int $num = 0): bool
{
  if ($num > PHP_INT_MAX)
    throw new RangeException('Number is too big. Maximum allowed num is: ' . PHP_INT_MAX);

  if ($num <= 3)
    return $num > 1;

  if ($num % 2 === 0 || $num % 3 === 0)
    return false;

  $idx = 5;
  while ($idx ** 2 <= $num) {
    if ($num % $idx === 0 || $num % ($idx + 2) === 0)
      return false;
    $idx += 6;
  }
  return true;
}
