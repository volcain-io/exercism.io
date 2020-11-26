<?php

define('DECIMAL_TO_HEX', [
  '10' => 'A',
  '11' => 'B',
  '12' => 'C',
  '13' => 'D',
  '14' => 'E',
  '15' => 'F',
  '16' => 'G',
]);

/**
 * Convert a number, represented as a sequence of digits in one base, to given target base.
 *
 * @param int $base The basic base to convert from (Default = 10).
 * @param array $digits The sequence of digits of $base (Default = [0]).
 * @param int $targetBase The target base to convert to (Default = 2).
 *
 * @return array The sequence of digits of $targetBase.
 */
function rebase(int $base = 10, array $digits = [0], int $targetBase = 2)
{
  if (invalidBase($base) || invalidDigits($base, $digits) || invalidBase($targetBase)) {
    return null;
  }

  return toBase($targetBase, toDecimal($base, $digits));
}

/**
 * Check if given base is invalid.
 *
 * @param int $base The number to check (Default = 10).
 *
 * @return `true` if invalid else `false`.
 */
function invalidBase(int $base = 10): bool
{
  return $base <= 1;
}

/**
 * Check if given digits are invalid.
 *
 * @param int $base The base to check the digits of (Default = 10).
 * @param int $digits The digits to check (Default = [0]).
 *
 * @return `true` if invalid else `false`.
 */
function invalidDigits(int $base = 10, array $digits = [0]): bool
{
  $elems = array_filter($digits, function ($val) use ($base) {
    return $val < 0 || $val >= $base;
  });

  return count($digits) === 0 || $digits[0] === 0 || count($elems) > 0;
}

/**
 * Convert given digits to decimal.
 *
 * @param int $base The base to check the digits of (Default = 10).
 * @param int $digits The digits to convert (Default = [0]).
 *
 * @return string The result as decimal.
 */
function toDecimal(int $base = 10, array $digits = [0]): string
{
  if ($base === 10) return join($digits);

  $decimal = '0';
  $rev = array_reverse($digits);
  foreach ($rev as $idx => $bit) {
    $decimal = bcadd($decimal, bcmul($bit, bcpow($base, $idx)));
  }

  return $decimal;
}

/**
 * Convert given digits to given a sequence of digits to given base.
 *
 * @param int $base The base to check the digits of (Default = 10).
 * @param int $decimal The decimal to convert (Default = '0').
 *
 * @return array The sequence of digits of $base.
 */
function toBase(int $base = 10, string $decimal = '0'): array
{
  if ($base === 10) return str_split($decimal);

  $output = [];

  while ($decimal > 0) {
    $remainder = bcmod($decimal, $base);

    // NOTE: Uncomment this, if you want to convert to real hexadecimal representation.
    // if ($base === 16) $remainder = toHex($remainder);

    $output[] = $remainder;
    $decimal = bcdiv($decimal, $base);
  }

  return array_reverse($output);
}

function toHex(string $decimal = '0'): string
{
  return $decimal > 9 ? DECIMAL_TO_HEX[$decimal] : $decimal;
}
