<?php

class VerseChunks
{
  const BOTTLES = "bottles";
  const GO_TO_THE_STORE_AND_BUY_SOME_MORE = "Go to the store and buy some more";
  const IT = "it";
  const NO_MORE_LOWER = "no more";
  const NO_MORE_UPPER = "No more";
  const X_OF_BEER = "%s of beer";
  const X_OF_BEER_ON_THE_WALL = self::X_OF_BEER . " on the wall";
  const ONE = "one";
  const TAKE_X_DOWN_AND_PASS_IT_AROUND = "Take %s down and pass it around";
}

class BeerSong
{
  const MIN_VERSE_NUM = 0;
  const MAX_VERSE_NUM = 99;

  /**
   * Create verse of beer song for given number.
   *
   * @param int $num The verse number.
   * @param int $num The verse number.
   *
   * @return The result as a string.
   *
   * @throws RangeException If given number is out of range (range=[0-99]).
   */
  public function verse(int $num): string
  {
    if ( $num < self::MIN_VERSE_NUM || $num > self::MAX_VERSE_NUM )
      throw new RangeException("Verse is out of range. Must be between " . self::MIN_VERSE_NUM . " and " . self::MAX_VERSE_NUM . ", but was " . $num);

    $line = VerseChunks::X_OF_BEER_ON_THE_WALL . ", " . VerseChunks::X_OF_BEER . ".\n" . VerseChunks::TAKE_X_DOWN_AND_PASS_IT_AROUND . ", " . VerseChunks::X_OF_BEER_ON_THE_WALL . ".";
    $first = $num . " " . VerseChunks::BOTTLES;
    $second = &$first;
    $third = VerseChunks::ONE;
    $fourth = ($num - 1) . " " . VerseChunks::BOTTLES;

    if ($num === self::MIN_VERSE_NUM) {
      unset($second);
      $line = str_replace(
        VerseChunks::TAKE_X_DOWN_AND_PASS_IT_AROUND,
        VerseChunks::GO_TO_THE_STORE_AND_BUY_SOME_MORE,
        $line
      );
      $first = VerseChunks::NO_MORE_UPPER . " " . VerseChunks::BOTTLES;
      $second = VerseChunks::NO_MORE_LOWER . " " . VerseChunks::BOTTLES;
      $third = self::MAX_VERSE_NUM . " " . VerseChunks::BOTTLES;
      $fourth = "";
    } elseif ($num === 1) {
      $first = mb_substr($first, 0, -1);
      $third = VerseChunks::IT;
      $fourth = VerseChunks::NO_MORE_LOWER . " " . VerseChunks::BOTTLES;
    } elseif ($num === 2) {
      $fourth = mb_substr($fourth, 0, -1);
    }

    if ($num > self::MIN_VERSE_NUM) $line .= "\n";

    return sprintf($line, $first, $second, $third, $fourth);
  }

  /**
   * Create all verses from `$start` to `$end`. `$start` must be greater than `$end`.
   *
   * @param int $start First value of the sequence.
   * @param int $end Last value of the sequence.
   *
   * @return The result as string.
   *
   * @throws RangeException If `$start` is less than `$end`.
   */
  public function verses(int $start, int $end): string
  {
    if ( $start < $end )
      throw new RangeException("Out of range. The start value must be greater than the end value.");

    $output = "";
    foreach (range($start, $end) as $num) {
      $output .= $this->verse($num) . "\n";
    }
    return substr($output, 0, -1);
  }

  /**
   * Create complete song. From verse 99 to 0.
   */
  public function lyrics(): string
  {
    return $this->verses(99, 0);
  }
}
