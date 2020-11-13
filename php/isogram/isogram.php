<?php

/**
 * Check, if given string is an isogram.
 *
 * @param string $word Any string
 *
 * @return bool
 */
function isIsogram(string $word = ""): bool
{
  $lower = mb_strtolower($word);
  $letterMap = [];
  $splitted = mb_str_split($lower);
  $max = count($splitted);
  for ($idx = 0; $idx < $max; $idx++) {
    $letter = $splitted[$idx];
    if (mb_isLetter($letter)) {
      if (isset($letterMap[$letter]) && $letterMap[$letter]) {
        return false;
      }
      $letterMap[$letter] = true;
    }
  }

  return true;
}

/**
 * Check, if given string is alpha string (unicode).
 *
 * @param string $char
 *
 * @return bool
 */
function mb_isLetter(string $char): bool
{
  return preg_match('/[[:alpha:]]/u', $char);
}
