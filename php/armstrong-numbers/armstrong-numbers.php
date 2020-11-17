<?php

/**
 * Determine whether a number is an Armstrong number.
 *
 * @param int $num The int to check.
 *
 * @return bool `true` if number is an Armstrong number, else `false`.
 */
function isArmstrongNumber(int $num = 0): bool
{
  if ($num < 0 || !is_int($num))
    throw new RangeException("Input must be a positive integer.");

  $sum = 0;
  $s_num = (string) $num;
  $len = strlen($s_num);
  for ($idx = 0; $idx < $len; $idx++) {
    $sum += $s_num[$idx] ** $len;
  }

  return $sum === $num;
}
