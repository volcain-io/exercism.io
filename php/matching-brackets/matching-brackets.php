<?php

define("BRACKETS", "[]");
define("BRACES", "{}");
define("PARENTHESES", "()");

define(
  "REGEX_PATTERN_NON_BRACKETS",
  '/[^' . preg_quote(BRACKETS) . preg_quote(BRACES) . preg_quote(PARENTHESES) . ']/'
);

/**
 * Given a string containing brackets, braces, parentheses, or any combination thereof,
 * verify that any and all pairs are matched and nested correctly.
 *
 * @param string $string The string to test.
 *
 * @return bool `true` on success, `false` on failure.
 */
function brackets_match(string $string = ""): bool
{
  $listOfBracketPairs = preg_replace(REGEX_PATTERN_NON_BRACKETS, '', $string);
  $len = strlen($listOfBracketPairs) / 2;
  for ($idx = 0; $idx < $len; $idx++) {
    $listOfBracketPairs = str_replace(BRACKETS, '', $listOfBracketPairs);
    $listOfBracketPairs = str_replace(BRACES, '', $listOfBracketPairs);
    $listOfBracketPairs = str_replace(PARENTHESES, '', $listOfBracketPairs);
  }

  return empty($listOfBracketPairs);
}
