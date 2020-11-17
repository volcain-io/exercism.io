<?php

define("FIRST_SQUARE", 1);
define("LAST_SQUARE", 64);

/**
 * Calculate number of grains on given square.
 *
 * @param int $exponent The square to calculate the grains for.
 *
 * @throws InvalidArgumentException If $num is not between 1 and 64.
 *
 * @return string The result as a string.
 */
function square(int $exponent): string
{
  if ($exponent >= FIRST_SQUARE && $exponent <= LAST_SQUARE)
    return bcpow(2, $exponent - 1);

  throw new InvalidArgumentException("Input must be between " . FIRST_SQUARE . "  and " . LAST_SQUARE . ", but was ${exponent}.");
}

/**
 * Calculate the total number of grains.
 *
 * @return string The result as a string.
 */
function total(): string
{
  return bcsub(PHP_INT_MAX, PHP_INT_MIN);
}
