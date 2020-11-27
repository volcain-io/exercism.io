<?php

/**
 * Given a string of digits, output all the contiguous substrings of length n in that string.
 *
 * @param string $digits The string of digits.
 * @param int $len The length of substring.
 *
 * @return array
 *
 * throws RangeException If given string does contain other characters than digits or the given length is invalid.
 */
function slices(string $digits, int $len): array
{
  try {
    $output = [];

    $max = strlen($digits);

    validateDigits($digits);
    validateLength($len, $max);

    $idx = 0;
    while ($idx < $max) {
      $sub = substr($digits, $idx, $len);
      if (isset($sub[$len - 1]))
        $output[] = $sub;
      $idx++;
    }

    return $output;
  } catch (Error | Exception $e) {
    throw $e;
  }
}

/**
 * Check for numeric characters in given string.
 *
 * @param string $digits The string to check. (Default = '')
 *
 * @return void
 *
 * @throws TypeError If passed argument type is invalid.
 * @throws RangeException If value of $digits contains a non-digit.
 */
function validateDigits(string $digits = ''): void
{
  if (!is_string($digits))
    throw new TypeError('TypeError: $digits must be of type int, but was: ' . gettype($digits));
  if (!ctype_digit($digits)) {
    throw new RangeException('Given strings must contain digits only.');
  }
}

/**
 * Check if given length is smaller or equal to given maximum.
 *
 * @param int $len The length to check. (Default = 1)
 * @param int $max The maximum length allowed. (Default = 1)
 *
 * @return void
 *
 * @throws TypeError If passed arguments types are invalid.
 * @throws RangeException If $len is equal to/less than zero or bigger than $max.
 */
function validateLength(int $len = 1, int $max = 1): void
{
  if (!is_int($len))
    throw new TypeError('TypeError: $len must be of type int, but was: ' . gettype($len));
  if (!is_int($max))
    throw new TypeError('TypeError: $max must be of type int, but was: ' . gettype($max));
  if ($len <= 0 || $len > $max)
    throw new RangeException('Given length is too big. It should be between 1 and ' . $max . ', but was: ' . $len);
}
