<?php

define('TRINARY_BASE', 3);

/**
 * Convert a trinary number to its decimal equivalent using first principles.
 *
 * @param string $trinaryNum String representig a trinary number, e.g '102012'
 *
 * @return int
 */
function toDecimal(string $trinaryNum): int
{
  // stop calculating for any non-trinary number
  if (preg_match('/[^012]/', $trinaryNum)) {
    return 0;
  }

  $sum = 0;
  $exponent = strlen($trinaryNum) - 1;
  $numList = str_split($trinaryNum);
  foreach ($numList as $digit) {
    $sum += $digit * pow(TRINARY_BASE, $exponent--);
  }

  return $sum;
}
