<?php

define("FIRST_SQUARE", 1);
define("LAST_SQUARE", 64);

/**
 * Calculate number of grains on given square.
 *
 * @param int $num The square to calculate the grains for.
 *
 * @throws InvalidArgumentException If $num is not between 1 and 64.
 *
 * @return string The result as a string.
 */
function square(int $num): string
{
  if ($num >= FIRST_SQUARE && $num <= LAST_SQUARE)
    return bcpow(2, $num - 1);

  throw new InvalidArgumentException("Input must be between " . FIRST_SQUARE . "  and " . LAST_SQUARE . ", but was ${num}.");
}

/**
 * Calculate the total number of grains.
 *
 * @throws InvalidArgumentException If exponent is not between 1 and 64.
 *
 * @return string The result as a string.
 */
function total(): string
{
  $total = 0;

  for($exponent = FIRST_SQUARE; $exponent <= LAST_SQUARE; $exponent++) {
    $power = square($exponent);
    $total = bcadd($total, $power);
  }

  return $total;
}
