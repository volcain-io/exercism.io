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
  $sum = 0;
  $splitted = str_split($num);
  $len = strlen($num);
  foreach ($splitted as $value) {
    $sum += $value ** $len;
  }

  return $sum === $num;
}
