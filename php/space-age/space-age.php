<?php

class SpaceAge
{
  private int $seconds;
  const EARTH_YEAR_IN_SECONDS = 3.15576e7;
  const ORBITAL_PERIOD_IN_EARTH_YEARS = [
    "earth" => 1,
    "jupiter" => 11.862615,
    "mars" => 1.8808158,
    "mercury" => 0.2408467,
    "neptune" => 164.79132,
    "saturn" => 29.447498,
    "uranus" => 84.016846,
    "venus" => 0.61519726,
  ];

  /**
   * Constructor.
   *
   * @param int $seconds The age in seconds.
   *
   */
  public function __construct(int $seconds)
  {
    $this->seconds = $seconds;
  }

  /**
   * Get age in seconds.
   *
   * @return int The result is the age in seconds.
   */
  public function seconds(): int
  {
    return $this->seconds;
  }

  /**
   * Calculate age in years on Earth.
   *
   * @return float The result is age in years on Earth.
   */
  public function earth(): float
  {
    return $this->round2digits(
      $this->seconds / self::EARTH_YEAR_IN_SECONDS / self::ORBITAL_PERIOD_IN_EARTH_YEARS["earth"]
    );
  }

  /**
   * Calculate age in years on Jupiter.
   *
   * @return float The result is age in years on Jupiter.
   */
  public function jupiter(): float
  {
    return $this->round2digits(
      $this->seconds / self::EARTH_YEAR_IN_SECONDS / self::ORBITAL_PERIOD_IN_EARTH_YEARS["jupiter"]
    );
  }

  /**
   * Calculate age in years on Mars.
   *
   * @return float The result is age in years on Mars.
   */
  public function mars(): float
  {
    return $this->round2digits(
      $this->seconds / self::EARTH_YEAR_IN_SECONDS / self::ORBITAL_PERIOD_IN_EARTH_YEARS["mars"]
    );
  }

  /**
   * Calculate age in years on Mercury.
   *
   * @return float The result is age in years on Mercury.
   */
  public function mercury(): float
  {
    return $this->round2digits(
      $this->seconds / self::EARTH_YEAR_IN_SECONDS / self::ORBITAL_PERIOD_IN_EARTH_YEARS["mercury"]
    );
  }

  /**
   * Calculate age in years on Neptune.
   *
   * @return float The result is age in years on Neptune.
   */
  public function neptune(): float
  {
    return $this->round2digits(
      $this->seconds / self::EARTH_YEAR_IN_SECONDS / self::ORBITAL_PERIOD_IN_EARTH_YEARS["neptune"]
    );
  }

  /**
   * Calculate age in years on Saturn.
   *
   * @return float The result is age in years on Saturn.
   */
  public function saturn(): float
  {
    return $this->round2digits(
      $this->seconds / self::EARTH_YEAR_IN_SECONDS / self::ORBITAL_PERIOD_IN_EARTH_YEARS["saturn"]
    );
  }

  /**
   * Calculate age in years on Uranus.
   *
   * @return float The result is age in years on Uranus.
   */
  public function uranus(): float
  {
    return $this->round2digits(
      $this->seconds / self::EARTH_YEAR_IN_SECONDS / self::ORBITAL_PERIOD_IN_EARTH_YEARS["uranus"]
    );
  }

  /**
   * Calculate age in years on Venus.
   *
   * @return float The result is age in years on Venus.
   */
  public function venus(): float
  {
    return $this->round2digits(
      $this->seconds / self::EARTH_YEAR_IN_SECONDS / self::ORBITAL_PERIOD_IN_EARTH_YEARS["venus"]
    );
  }

  /**
   * Round given float number to two decimal digits.
   *
   * @param float $number The value to round.
   *
   * @return float The rounded value.
   */
  private function round2Digits(float $number): float
  {
    return round($number, 2);
  }
}
