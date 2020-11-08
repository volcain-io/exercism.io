<?php

/**
 * Frame consists of each roll and the bonus points.
 */
class Frame
{
  public const MIN_PINS = 0;
  public const MAX_PINS = 10;
  private int $firstRoll;
  private int $secondRoll;
  private int $bonus;
  private bool $isSetFirstRoll;
  private bool $isSetSecondRoll;

  /**
   * Constructor.
   */
  function __construct()
  {
    $this->firstRoll = 0;
    $this->secondRoll = 0;
    $this->bonus = 0;
    $this->isSetFirstRoll = false;
    $this->isSetSecondRoll = false;
  }

  /**
   * Get number of pins knocked down on first roll
   *
   * @return int
   */
  public function getPinsOfFirstRoll(): int
  {
    return $this->firstRoll;
  }

  /**
   * Get number pins knocked down on second roll
   *
   * @return int
   */
  public function getPinsOfSecondRoll(): int
  {
    return $this->secondRoll;
  }

  /**
   * Get number of pins knocked down in total (first + second roll)
   *
   * @throws Exception If total number is greater than 10
   *
   * @return int
   */
  public function getScore(): int
  {
    $score = $this->getPinsOfFirstRoll() + $this->getPinsOfSecondRoll();
    if ($score > self::MAX_PINS)
      throw new Exception('Too many pins.');
    return $score;
  }

  /**
   * Get bonus points if there is any.
   *
   * @return int
   */
  public function getBonus(): int
  {
    return $this->bonus;
  }

  /**
   * Get total score of frame (first + second roll + bonus points).
   *
   * @return int
   */
  public function getTotalScore(): int
  {
    return $this->getScore() + $this->getBonus();
  }

  /**
   * Set number of pins knocked down on first roll, if it is not already set.
   *
   * @param int $pins Number of pins knocked down
   *
   * @return void
   */
  public function setPinsOfFirstRoll(int $pins): void
  {
    if (!$this->isSetFirstRoll) {
      $this->firstRoll = $pins;
      $this->isSetFirstRoll = true;
    }
  }

  /**
   * Set number of pins knocked down on second roll, if it is not already set.
   *
   * @param int $pins Number of pins knocked down
   *
   * @return void
   */
  public function setPinsOfSecondRoll(int $pins): void
  {
    if (!$this->isSetSecondRoll) {
      $this->secondRoll = $pins;
      $this->isSetSecondRoll = true;
    }
  }

  /**
   * Set bonus points, if there is any.
   *
   * @param int $bonus Number of bonus points.
   *
   * @return void
   */
  public function setBonus(int $bonus): void
  {
    $this->bonus = $bonus;
  }
}

class Game
{
  private array $listOfThrows;
  private array $listOfFrames;
  private int $score;

  /**
   * Constructor.
   */
  function __construct()
  {
    $this->listOfThrows = [];
    $this->listOfFrames = [];
    $this->score = 0;
  }

  /**
   * Called each time the player rolls a ball.
   *
   * @param int $pins Number of pins knocked down.
   *
   * @throws \Exception
   *
   * @return void
   */
  public function roll(int $pins): void
  {
    if ($pins < Frame::MIN_PINS || $pins > Frame::MAX_PINS) {
      throw new \Exception('You can only knock down between ' . Frame::MIN_PINS . ' and ' . Frame::MAX_PINS . ' pins.');
    }
    // we need to collect all rolls first to create an array of Frame objects from the collection.
    $this->listOfThrows[] = $pins;
  }

  /**
   * Called at the very end of the game and returns the total score for the game.
   *
   * @throws \Exception
   *
   * @return int
   */
  public function score(): int
  {
    $this->createFramesAndCalculateScore();

    // check last frame for special cases and throw an exception if an error occurs
    $this->checkLastFrame();

    return $this->score;
  }

  /**
   * Create an array of Frame objects and calculate the total score of the game.
   *
   * @throws \Exception If a game is incomplete or unstarted.
   *
   * @return void
   */
  private function createFramesAndCalculateScore(): void
  {
    unset($this->listOfFrames);
    $this->score = 0;

    $throwIdx = 0;
    for ($numFrames = 0; $numFrames < 10; $numFrames++) {
      // check if game is incomplete or unstarted
      if (array_key_exists($throwIdx, $this->listOfThrows) && array_key_exists($throwIdx + 1, $this->listOfThrows)) {
        $throw = $this->listOfThrows[$throwIdx];

        $isStrike = $throw === Frame::MAX_PINS;
        $isSpare = $throw + $this->listOfThrows[$throwIdx + 1] === Frame::MAX_PINS;
        if ($isStrike) {
          // check that bonus roll must be rolled before score can be calculated
          if (!array_key_exists($throwIdx + 2, $this->listOfThrows)) {
            throw new Exception('Invalid range');
          }

          $frame = new Frame();
          $frame->setPinsOfFirstRoll($throw);
          $frame->setPinsOfSecondRoll(0);
          $frame->setBonus($this->listOfThrows[$throwIdx + 1] + $this->listOfThrows[$throwIdx + 2]);

          $this->score += $frame->getTotalScore();
          $this->listOfFrames[] = $frame;
          $throwIdx++;
        } elseif ($isSpare) {
          // check that bonus roll must be rolled before score can be calculated
          if (!array_key_exists($throwIdx + 2, $this->listOfThrows)) {
            throw new Exception('Invalid range');
          }

          $frame = new Frame();
          $frame->setPinsOfFirstRoll($throw);
          $frame->setPinsOfSecondRoll($this->listOfThrows[$throwIdx + 1]);
          $frame->setBonus($this->listOfThrows[$throwIdx + 2]);

          $this->score += $frame->getTotalScore();
          $this->listOfFrames[] = $frame;
          $throwIdx += 2;
        } else {
          $frame = new Frame();
          $frame->setPinsOfFirstRoll($throw);
          $frame->setPinsOfSecondRoll($this->listOfThrows[$throwIdx + 1]);
          $frame->setBonus(0);

          $this->score += $frame->getTotalScore();
          $this->listOfFrames[] = $frame;
          $throwIdx += 2;
        }
      } else {
        throw new Exception('Invalid Range.');
      }
    }
  }

  /**
   * Two special cases in last frame to be checked.
   * - Two bonus rolls after a strike in the last frame cannot score more than 10 points.
   * - A game with more than ten frames cannot be scored.
   *
   * @throws Exception
   *
   * @return void
   */
  private function checkLastFrame(): void
  {
    $frame = array_reverse($this->listOfFrames)[0];

    // two bonus rolls after a strike in the last frame cannot score more than 10 points.
    $firstRoll = $frame->getPinsOfFirstRoll();
    $bonus = $frame->getBonus();
    if ($firstRoll === Frame::MAX_PINS && $bonus > Frame::MAX_PINS && $bonus !== (Frame::MAX_PINS * 2))
      throw new Exception('Too many pins');

    // a game with more than ten frames cannot be scored.
    $score = $frame->getScore();
    if ($score < Frame::MAX_PINS && count($this->listOfThrows) > 20 ) {
      throw new Exception('Too many frames');
    }
  }
}
