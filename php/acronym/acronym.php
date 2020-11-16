<?php

mb_internal_encoding("UTF-8");

/**
 * Convert given string to its acronym with UTF-8 support.
 *
 * @param string $string The string being converted.
 *
 * @return string The result is the acronym of the given string.
 */
function acronym(string $string = ""): string
{
  $listOfWords = explode(" ", mb_remove_any_non_letter($string));

  $acronym = "";
  if (count($listOfWords) > 1) {
    foreach ($listOfWords as $word) {
      $letters = getUppercaseLettersFromCamelCase($word);
      $acronym .= empty($letters) ? mb_substr($word, 0, 1) : $letters;
    }
  }

  return mb_strtoupper($acronym);
}

/**
 * Remove any character, which is not an uppercase or lowercase letter with UTF-8 support.
 *
 * @param string $string The string being replaced.
 *
 * @return string The result contains uppercase and/or lowercase letters only, or false on error.
 */
function mb_remove_any_non_letter(string $string = ""): string
{
  return preg_replace('/[^[:lower:][:upper:]]/u', " ", $string);
}

/**
 * Check if given string is camel case and return a string containg all uppercase letters with UTF-8 support.
 *
 * @param string $string Any string.
 *
 * @return string The result as a string.
 */
function getUppercaseLettersFromCamelCase(string $string = ""): string
{
  $output = "";

  $trimmed = trim($string);

  if (
    strlen($trimmed) > 0 &&
    !ctype_space($trimmed) &&
    preg_match('/[[:upper:]][[:lower:]]+[[:upper:]]+/u', $trimmed)
  ) {
    $letters = preg_split('/[[:lower:]]/u', $trimmed, -1, PREG_SPLIT_NO_EMPTY);
    if ( $letters ) {
      return implode('', $letters);
    }
  }

  return $output;
}
