<?php

/**
 * Calculate the square of the sum of the first N natural numbers.
 *
 * @param int $num A natural number
 *
 * @return int
 */
function squareOfSum(int $num): int
{
  // sum of sequence: k = (n²+n)/2
  return pow(($num * $num + $num) / 2, 2);
}

/**
 * Calculate the sum of the squares of the first N natural numbers.
 *
 * @param int $n A natural number
 *
 * @return int
 */
function sumOfSquares(int $num): int
{
  // sum of square sequence: k² = (n(n+1)(2n+1))/6
  return $num * ($num + 1) * (2 * $num + 1) / 6;
}

/**
 * Return the difference between the square of the sum and the sum of the squares of the first N natural numbers.
 *
 * @param int $num A natural number
 *
 * @return int
 */
function difference(int $num): int
{
  return squareOfSum($num) - sumOfSquares($num);
}
