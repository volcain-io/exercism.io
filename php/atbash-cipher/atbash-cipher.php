<?php

// define atbash cipher map
define("CIPHER_MAP", [
  "a" => "z", "b" => "y", "c" => "x",
  "d" => "w", "e" => "v", "f" => "u",
  "g" => "t", "h" => "s", "i" => "r",
  "j" => "q", "k" => "p", "l" => "o",
  "m" => "n", "n" => "m", "o" => "l",
  "p" => "k", "q" => "j", "r" => "i",
  "s" => "h", "t" => "g", "u" => "f",
  "v" => "e", "w" => "d", "x" => "c",
  "y" => "b", "z" => "a"
]);

/**
 * Remove all none alpha-numeric (letters and digits) from string.
 *
 * @param string $string Any string.
 *
 * @return string Text with alpha-numeric characters only.
 */
function remove_none_alnum(string $string): string
{
  return preg_replace('/[^[:alnum:]]/u', '', $string);
}

/**
 * Group letters to a word of maximum length of 5.
 *
 * @param string $string Any string.
 *
 * @return string
 */
function group_letters(string $string): string
{
  $output = mb_substr($string, 0, 5);

  $max = mb_strlen($string);
  $idx = 5;
  while ($idx < $max) {
    $output .= " " . mb_substr($string, $idx, 5);
    $idx += 5;
  }

  return $output;
}

/**
 * Atbash cipher implementation. Simple substitution cipher that relies on transposing
 * all the letters in the alphabet such that the resulting alphabet is backwards.
 *
 * @param string $string Plain text.
 *
 * @return string
 */
function atbash(string $string): string
{
  $output = "";

  $listOfLetters = mb_str_split($string);
  foreach ($listOfLetters as $letter) {
    $output .= CIPHER_MAP[$letter] ?? $letter;
  }

  return $output;
}

/**
 * Encode plain text to atbash cipher.
 *
 * @param string $string Plain text to encode.
 *
 * @return string Encoded plain text as atbash cipher.
 */
function encode(string $string): string
{
  return group_letters(decode($string));
}

/**
 * Decode atbash cipher to plain text.
 *
 * @param string $string Atbash cipher to decode.
 *
 * @return string Decoded atbash cipher as plain text.
 */
function decode(string $string): string
{
  return atbash(remove_none_alnum(strtolower($string)));
}
