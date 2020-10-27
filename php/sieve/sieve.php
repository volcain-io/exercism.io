<?php

/**
 * Finds all primes from 2 up to a given limit using the Sieve of Eratosthenes method.
 *
 * @param int $limit Any integer
 *
 * @return array A list of primes numbers up to $limit.
 */
function sieve(int $limit): array
{
  $listOfPrimes = array_fill(2, $limit - 1, TRUE);

  for ($i = 2; $i <= $limit; $i++) {
      for ($j = $i * $i; $j <= $limit; $j += $i) {
        unset($listOfPrimes[$j]);
      }
  }

  return array_keys($listOfPrimes);
}
