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

  function __construct()
  {
    $this->firstRoll = 0;
    $this->secondRoll = 0;
    $this->bonus = 0;
    $this->isSetFirstRoll = false;
    $this->isSetSecondRoll = false;
  }

  public function getPinsOfFirstRoll(): int
  {
    return $this->firstRoll;
  }

  public function getPinsOfSecondRoll(): int
  {
    return $this->secondRoll;
  }

  public function getScore(): int
  {
    $score = $this->getPinsOfFirstRoll() + $this->getPinsOfSecondRoll();
    if ($score > self::MAX_PINS)
      throw new Exception('Too many pins.');
    return $score;
  }

  public function getBonus(): int
  {
    return $this->bonus;
  }

  public function getTotalScore(): int
  {
    return $this->getScore() + $this->getBonus();
  }

  public function setPinsOfFirstRoll(int $pins): void
  {
    if (!$this->isSetFirstRoll) {
      $this->firstRoll = $pins;
      $this->isSetFirstRoll = true;
    }
  }

  public function setPinsOfSecondRoll(int $pins): void
  {
    if (!$this->isSetSecondRoll) {
      $this->secondRoll = $pins;
      $this->isSetSecondRoll = true;
    }
  }

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
   * Create an array of Frame objects.
   *
   * @throws \Exception
   *
   * @return void
   */
  private function createFrames()
  {
    unset($this->listOfFrames);
    $this->score = 0;

    $throwIdx = 0;
    for ($numFrames = 0; $numFrames < 10; $numFrames++) {
      if (array_key_exists($throwIdx, $this->listOfThrows) && array_key_exists($throwIdx + 1, $this->listOfThrows)) {
        $throw = $this->listOfThrows[$throwIdx];

        $isStrike = $throw === Frame::MAX_PINS;
        $isSpare = $throw + $this->listOfThrows[$throwIdx + 1] === Frame::MAX_PINS;
        if ($isStrike) {
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
   * Called at the very end of the game and returns the total score for the game.
   *
   * @throws \Exception
   *
   * @return int
   */
  public function score(): int
  {
    // create a list frames with all the points the user makes
    $this->createFrames();

    $this->checkLastFrame();

    return $this->score;
  }

  /**
   * Special case in last frame. Two bonus rolls after a strike in the last frame cannot score more than 10 points.
   */
  private function checkLastFrame()
  {
    $frame = array_reverse($this->listOfFrames)[0];
    $firstRoll = $frame->getPinsOfFirstRoll();
    $bonus = $frame->getBonus();

    if ($firstRoll === 10 && $bonus > 10 && $bonus !== 20)
      throw new Exception('Too many pins');
  }
}
