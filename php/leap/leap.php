<?php

/**
 * Reports if the given year is a leap year (according to Gregorian calendar).
 *
 * @param int $year Full year, e.g. 1997
 *
 * @return bool If given year is a leap year return `true`, else `false`.
 */
function isLeap(int $year): bool {
  return $year % 4 === 0 && ($year % 100 !== 0 || $year % 400 === 0 );
}
