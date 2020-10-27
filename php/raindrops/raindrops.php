<?php

define('FACTOR_SOUND_DICT', [3 => "Pling", 5 => "Plang", 7 => "Plong"]);

/**
 * Convert a number into a string that contains raindrop sounds corresponding to
 * certain potential factors.
 *
 * @param int $number Any integer
 *
 * @return string A string that contains raindrop sounds or given $number if no sound found.
 */
function raindrops(int $number): string
{
  $result = "";
  foreach (FACTOR_SOUND_DICT as $factor => $sound) {
    if ($number % $factor === 0) {
      $result .= $sound;
    }
  }

  return $result === "" ? $number : $result;
}
