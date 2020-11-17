<?php

/**
 * Given a number, return the number of steps required to reach 1.
 *
 * @param int $num The int to calculate steps for.
 *
 * @throws InvalidArgumentException If $num is not positive.
 *
 * @return int The result as integer value.
 */
function steps(int $num = 0): int {
  if ($num <= 0) throw new InvalidArgumentException('Only positive numbers are allowed');

  $count = 0;

  while ($num > 1) {
    $num = $num % 2 ? 3 * $num + 1 : $num / 2;
    $count++;
  }

  return $count;
}
