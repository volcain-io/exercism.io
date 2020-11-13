<?php

/**
 * Determine whether or not $number is valid per the Luhn formula.
 *
 * @param string $number Any string containing numbers only.
 *
 * @return bool
 */
function isValid(string $number = ""): bool
{
  $stripped = preg_replace('/[[:space:]]/u', '', $number);

  return isValidLength($stripped) && is_numeric($stripped) && evenlyDivisibleByTen(luhn($stripped));
}

/**
 * Check, if $string's length is greater or equal than 2.
 *
 * @param string $string Any string.
 *
 * @return bool
 */
function isValidLength(string $string = ""): bool
{
  return mb_strlen($string) >= 2;
}

/**
 * Check, if $num is evenly divisible by 10.
 *
 * @param int $num Any integer.
 *
 * @return bool
 */
function evenlyDivisibleByTen(int $num = 0): bool
{
  return $num % 10 === 0;
}

/**
 * Calculate luhn number per formula: f(x): x = n * 2; if x > 9 then x = x - 9
 *
 * @param string $string Any numerical string.
 *
 * @return int
 */
function luhn(string $string = ""): int
{
  $sum = 0;
  // Formula to calculate the (doubled) value of a single digit 'x': x = n * 2; if x > 9 then x = x - 9
  // We can simplify the formula even further using modulo: if n < 9 then x = n * 2 % 9 else x = n
  // So if we calculate 'x' for each digit (n < 9) with the formula above, we get following values for n=[0-8]:
  //  n = 0 ==> 'x' = 0
  //  n = 1 ==> 'x' = 2
  //  n = 2 ==> 'x' = 4
  //  ...
  //  n = 7 ==> 'x' = 5
  //  n = 8 ==> 'x' = 7
  //  n = 9 ==> 'x' = 9
  // Now we can setup a map with the corresponding values of the doubled digits to retrieve our desired value.
  // This means we do not need any math calculation to get the doubled digit. We can simply use the following index:
  //  ( 0: 0, 1: 2, 2: 4, 3: 6, 4: 8, 5: 1, 6: 3, 7: 5, 8: 7, 9: 9 )
  $doubleIndex = [0, 2, 4, 6, 8, 1, 3, 5, 7, 9];

  # start reading from right to left, because we need every second digit from right
  $idx = mb_strlen($string) - 1;
  while ($idx >= 0) {
    $digit = mb_substr($string, (-1) * $idx, 1);
    if ($idx % 2 === 0) $digit = $doubleIndex[$digit];
    $sum += $digit;
    $idx--;
  }

  return $sum;
}
