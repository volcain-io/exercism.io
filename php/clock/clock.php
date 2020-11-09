<?php

/**
 * @author Volkan Erdogan <volcain.io@gmail.com>
 * @link https://exercism.io/tracks/php/exercises/clock
 */
class Clock
{
  private const UNIX_EPOCH_DAY = 1;
  private const UNIX_EPOCH_MONTH = 1;
  private const UNIX_EPOCH_YEAR = 1970;
  private DateTime $dateTime;

  /**
   * Constructor.
   *
   * @param int $hours - Hours of the time.
   * @param int $minutes - Minutes of the time.
   */
  public function __construct(int $hours = 0, int $minutes = 0)
  {
    $this->dateTime = new DateTime('now', new DateTimeZone('UTC'));
    $this->setTime($hours, $minutes);
  }

  /**
   * Add amounts of minutes to clock.
   *
   * @param int $minutes Amount of minutes to add
   *
   * @throws \RangeException
   *
   * @return \Clock
   */
  public function add(int $minutes = 0): \Clock
  {
    if ($minutes < 0)
      return $this->sub((-1) * $minutes);

    $this->dateTime->add(new DateInterval("PT{$minutes}M"));
    $this->setDateToUnixEpoch();

    return $this;
  }

  /**
   * Subtracts amounts of minutes from clock.
   *
   * @param int $minutes Amount of minutes to subtract
   *
   * @throws \RangeException
   *
   * @return \Clock
   */
  public function sub(int $minutes = 0): \Clock
  {
    if ($minutes < 0)
      return $this->add((-1) * $minutes);

    $this->dateTime->sub(new DateInterval("PT{$minutes}M"));
    $this->setDateToUnixEpoch();

    return $this;
  }

  /**
   * Set hours and minutes of clock.
   *
   * Adds positive hours/minutes to the clock beginning at midnight.
   * Subtracts negative hours/minutes from the clock beginning at midnight.
   *
   * @param int $hours Amount of hours to add/subtract
   * @param int $minutes Amount of minutes to add/subtract
   *
   * @return void
   */
  private function setTime(int $hours, int $minutes): void
  {
    $this->dateTime->setTime(0, 0);

    if ($hours > 0) {
      $this->add($hours * 60);
    } else {
      $this->sub((-1) * $hours * 60);
    }
    if ($minutes > 0) {
      $this->add($minutes);
    } else {
      $this->sub((-1) * $minutes);
    }
  }

  /**
   * Set date of the \Clock object to Unix epoch. Since we modify the time, date must remain unchanged.
   *
   * @return void
   */
  private function setDateToUnixEpoch(): void
  {
    if ($this->dateTime !== null)
      $this->dateTime->setDate(self::UNIX_EPOCH_YEAR, self::UNIX_EPOCH_MONTH, self::UNIX_EPOCH_DAY);
  }

  /**
   * String representation of \Clock object.
   *
   * @return string Returns a string in the format HH:MM.
   */
  public function __toString(): string
  {
    return $this->dateTime !== null ? $this->dateTime->format("H:i") : "00:00";
  }
}
