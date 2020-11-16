<?php

class Triangle
{
  private float $sideA;
  private float $sideB;
  private float $sideC;

  /**
   * Constructor
   *
   * @param float $sideA The integer value of side A.
   * @param float $sideB The integer value of side B.
   * @param float $sideC The integer value of side C.
   */
  public function __construct(float $sideA = 0, float $sideB = 0, float $sideC = 0)
  {
    $this->sideA = $sideA;
    $this->sideB = $sideB;
    $this->sideC = $sideC;
  }

  /**
   * Calculate the triangle equality. The sum of the lengths of any two sides must be greater than or equal to the length of the third side.
   *
   * @return bool The result is `true` for a shape being a triangle, else `false`.
   */
  public function isTriangle(): bool
  {
    return $this->sideA + $this->sideB + $this->sideC > 2 * max($this->sideA, $this->sideB, $this->sideC);
  }

  /**
   * Determine if a triangle is equilateral, isosceles or scalene.
   *
   * @return string The result is either 'equilateral', 'isosceles' or 'scalene'.
   * - 'equilateral': All three sides has the same length
   * - 'isosceles': At least two sides with same length
   * - 'scalene': All three sides has different length
   */
  public function kind(): string
  {
    if ($this->isTriangle()) {
      $sideSet = [];

      $sideSet["" . $this->sideA] = true;
      $sideSet["" . $this->sideB] = true;
      $sideSet["" . $this->sideC] = true;

      if (count($sideSet) === 1) return "equilateral";
      if (count($sideSet) === 2) return "isosceles";

      return "scalene";
    } else {
      throw new RangeException("Illegal triangle values");
    }
  }
}
