<?php

/**
 * Calculate the scrabble score for given word.
 *
 * @param string $word The string to calculate to score for.
 *
 * @return int The calculated scrabble score as integer.
 */
function score(string $word = ""): int
{
  $sum = 0;

  for ($idx = 0; $idx < strlen($word); $idx++) {
    $char = substr($word, $idx, 1);
    switch (true) {
      case preg_match("/[aeilnorstu]/i", $char):
        $sum += 1;
        break;
      case preg_match("/[dg]/i", $char):
        $sum += 2;
        break;
      case preg_match("/[bcmp]/i", $char):
        $sum += 3;
        break;
      case preg_match("/[fhvwy]/i", $char):
        $sum += 4;
        break;
      case preg_match("/[k]/i", $char):
        $sum += 5;
        break;
      case preg_match("/[jx]/i", $char):
        $sum += 8;
        break;
      case preg_match("/[qz]/i", $char):
        $sum += 10;
        break;
      default:
        $sum += 0;
    }
  }

  return $sum;
}
