<?php

/**
 * Compute the prime factors of natural number $num.
 *
 * @param int $num The number to compute.
 *
 * @return array The list of prime factors of $num.
 *
 * @throws RangeException If given natural number is greater than `PHP_INT_MAX`.
 */
function factors(int $num): array
{
  if ($num > PHP_INT_MAX)
    throw new RangeException('Number is too big. Maximum allowed num is: ' . PHP_INT_MAX);

  $primeFactors = [];

  if ($num <= 1)
    return $primeFactors;

  $primeNumber = 2;
  while ($num != 1) {
    if ($num % $primeNumber === 0) {
      $num = $num / $primeNumber;
      $primeFactors[] = $primeNumber;
    } else {
      nextPrimeNumber($primeNumber);
    }
  }
  return $primeFactors;
}

/**
 * Calculate next prime number. Modifies the input number.
 *
 * @param int $num The number to start at.
 *
 * @return void
 */
function nextPrimeNumber(int &$num): void
{
  while (!isPrimeNumber(++$num));
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
function isPrimeNumber(int $num): bool
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
