<?php

define("OPENING_BRACKET", "[");
define("CLOSING_BRACKET", "]");
define("OPENING_BRACE", "{");
define("CLOSING_BRACE", "}");
define("CLOSING_PARENTHESE", ")");
define("OPENING_PARENTHESE", "(");

define("BRACKETS", OPENING_BRACKET . CLOSING_BRACKET);
define("BRACES", OPENING_BRACE . CLOSING_BRACE);
define("PARENTHESES", OPENING_PARENTHESE . CLOSING_PARENTHESE);

define(
  "REGEX_PATTERN_NON_BRACKETS",
  '/[^' .
    '\\' . OPENING_BRACKET . '\\' . CLOSING_BRACKET .
    '\\' . OPENING_BRACE . '\\' . CLOSING_BRACE .
    '\\' . OPENING_PARENTHESE . '\\' . CLOSING_PARENTHESE .
    ']/'
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
  return hasEqualPairs($string) && verifyPairs($string);
}

/**
 * Check if brackets, braces or parentheses have pairs.
 *
 * @param string $string The string to check.
 *
 * @return bool `true` on success, `false` on failure.
 */
function hasEqualPairs(string $string = ""): bool
{
  $equalBrackets = substr_count($string, OPENING_BRACKET) === substr_count($string, CLOSING_BRACKET);
  $equalBraces = substr_count($string, OPENING_BRACE) === substr_count($string, CLOSING_BRACE);
  $equalParentheses = substr_count($string, OPENING_PARENTHESE) === substr_count($string, CLOSING_PARENTHESE);

  return $equalBrackets && $equalBraces && $equalParentheses;
}

/**
 * Verify that brackets, braces or parentheses are nested correctly.
 *
 * @param string $string The string to verify.
 *
 * @return bool `true` on success, `false` on failure.
 */
function verifyPairs(string $string = ""): bool
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
