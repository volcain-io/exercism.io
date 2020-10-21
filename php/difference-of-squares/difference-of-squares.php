<?php

/**
 * Calculate the square of the sum of the first N natural numbers.
 *
 * @param int $value A natural number
 *
 * @return int
 */
function squareOfSum(int $value): int
{
  $sum = $value;
  while ($value > 0) {
    $sum += --$value;
  }
  return pow($sum, 2);
}

/**
 * Calculate the sum of the squares of the first N natural numbers.
 *
 * @param int $value A natural number
 *
 * @return int
 */
function sumOfSquares(int $value): int
{
  $sum = pow($value, 2);
  while ($value > 0) {
    $sum += pow(--$value, 2);
  }
  return $sum;
}

/**
 * Return the difference between the square of the sum and the sum of the squares of the first N natural numbers.
 *
 * @param int $value A natural number
 *
 * @return int
 */
function difference(int $value): int
{
  return squareOfSum($value) - sumOfSquares($value);
}
