<?php

define("MAP_OF_ROMAN_NUMERALS", [
  1000 => "M",
  900 => "CM",
  500 => "D",
  400 => "CD",
  100 => "C",
  90 => "XC",
  50 => "L",
  40 => "XL",
  10 => "X",
  9 => "IX",
  5 => "V",
  4 => "IV",
  1 => "I",
]);

/**
 * Convert from normal numbers to roman numerals.
 *
 * @param int $num Any integer.
 *
 * @return string The Roman Numeral representation of the given number.
 */
function toRoman(int $num): string {
  $result = "";

  foreach(MAP_OF_ROMAN_NUMERALS as $key => $value) {
    while ( $key <= $num ) {
      $num -= $key;
      $result .= $value;
    }
  }

  return $result;
}
