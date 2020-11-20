<?php

/**
 * Binary search algoritm
 *
 * @param int $target The number to search for.
 * @param array $array The list of numbers to search in.
 *
 * @result int The index of target. If target is not found returns -1.
 */
function find(int $target, array $array): int
{
  $left = 0;
  $right = count($array) - 1;
  while ($left <= $right) {
    $middle = floor(($left + $right) / 2);
    if ($array[$middle] < $target) {
      $left = $middle + 1;
    } elseif ($array[$middle] > $target) {
      $right = $middle - 1;
    } else {
      return $middle;
    }
  }
  return -1;
}
