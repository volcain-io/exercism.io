<?php

/**
 * Convert the given binary number, represented as a string, to its decimal equivalent using first principles.
 *
 * @param string $binary The string to convert.
 *
 * @return string The decimal value of $binary.
 *
 * @throws InvalidArgumentException If given string is not a valid binary string.
 */
function parse_binary(string $binary = ""): string
{
  if (!isValidBinary($binary)) {
    throw new InvalidArgumentException("Invalid input. Only 0's and 1's allowed.");
  }

  $decimal = "0";
  $rev = strrev($binary);
  $idx = strlen($rev) - 1;
  while (0 <= $idx) {
    $decimal = bcadd($decimal, bcmul($rev[$idx], bcpow(2, $idx)));
    $idx--;
  }

  return $decimal;
}

/**
 * Validate, that given string is a valid binary number.
 *
 * @param string $binary The string to validate.
 *
 * @return `true` on success, `false` on failure.
 */
function isValidBinary(string $binary = ""): bool
{
  return preg_match('/^[01]+$/u', $binary);
}
