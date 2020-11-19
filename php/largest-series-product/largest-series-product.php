<?php

class Series
{
  private string $digits;
  private array $integers;

  /**
   * Constructor.
   *
   * @param string $digits The string of digits.
   */
  public function __construct(string $digits = "")
  {
    $this->digits = $digits;
    $this->integers = str_split($this->digits);
  }

  /**
   * Calculate the largest product for a contiguous substring of digits of length n.
   *
   * @param int $length The length of substrings.
   *
   * @return The largest product for length n.
   *
   * @throws InvalidArgumentException
   */
  public function largestProduct(int $length): int
  {
    try {
      $this->validate($length);

      $output = 0;
      $keys = array_keys($this->integers);
      foreach ($keys as $key) {
        $subset = array_slice($this->integers, $key, $length);
        if (count($subset) === $length) {
          $product = array_reduce($subset, [$this, "product"], 1);
          $output = max($output, $product);
        }
      }
      return $output;
    } catch (InvalidArgumentException $e) {
      throw $e;
    }
  }

  /**
   * Callback function to calculate the product.
   *
   * @param string acc The accumulator.
   * @param string The current value.
   *
   * @return string The result as string.
   */
  private function product(int $acc, string $val): int
  {
    return $acc * $val;
  }

  /**
   * Validate input.
   *
   * @param int $length The length of substrings.
   *
   * @return void
   *
   * @throws InvalidArgumentException
   */
  private function validate(int $length)
  {
    if (preg_match('/[^0-9]/u', $this->digits)) {
      throw new InvalidArgumentException("Only digits allowed.");
    }

    if ($length > strlen($this->digits)) {
      throw new InvalidArgumentException("Substring length greater then length of input string.");
    }

    if ($length < 0) {
      throw new InvalidArgumentException("Negative length.");
    }
  }
}
