<?php

/**
 * Given a number, find the sum of all the unique multiples of particular
 * numbers up to but not including that number.
 *
 * @param int $num The number to find the sum of all unique multiples.
 * @param array $multiples The mulitples to search for.
 *
 * @return int The sum of all unique multiples.
 */
function sumOfMultiples(int $num, array $multiples): int
{
  $allMultiples = [];
  $possibleNumbers = range(1, $num - 1);
  foreach ($possibleNumbers as $curr) {
    foreach ($multiples as $multiple) {
      if ($multiple !== 0 && $curr % $multiple === 0) $allMultiples[$curr] = true;
    }
  }
  return array_sum(array_keys($allMultiples));
}
