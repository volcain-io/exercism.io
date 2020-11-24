<?php

/**
 *
 * @param int $num The number to classify. Default value is 1.
 *
 * @return string The classification of given number.
 *
 * @throw InvalidArgumentException If given number is either not number or not greater 0.
 */
function getClassification(int $num = 1): string
{
  if (!is_int($num) || $num <= 0)
    throw new InvalidArgumentException('Invalid number. Must be greater 0, but was: ' . $num);

  $classifications = ["deficient", "perfect", "abundant"];
  $comparison = aliquotSum($num) <=> $num;

  return $classifications[$comparison + 1];
}

/**
 * Calculate the Aliquot Sum of given number.
 *
 * @param int $num The number to calculate the Aliquot Sum for.
 *
 * @return int The result as int.
 */
function aliquotSum(int $num = 1): int
{
  return array_sum(positiveFactorsOf($num));
}

/**
 * Create a list of factors for given number.
 *
 * @param int $num The number to create the list of factors for.
 *
 * @return array The list of factors of given number $num.
 */
function positiveFactorsOf(int $num = 1): array
{
  $output = [];

  if ($num > 1)
    $output[1] = true;

  $divisor = 2;
  $quotient = $num / $divisor;
  while ($quotient > $divisor) {
    if ($num % $divisor === 0) {
      $quotient = $num / $divisor;
      $output[$quotient] = true;
      $output[$divisor] = true;
    }
    $divisor++;
  }

  return array_keys($output);
}
