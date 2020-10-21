<?php

class Robot
{
  // possible directions for our robot
  const DIRECTION_NORTH = 1;
  const DIRECTION_EAST = 2;
  const DIRECTION_SOUTH = 3;
  const DIRECTION_WEST = 4;
  // possible instructions for our robot
  const INSTRUCTION_ADVANCE = "A";
  const INSTRUCTION_TURN_RIGHT = "R";
  const INSTRUCTION_TURN_LEFT = "L";
  const UNKNOWN_STEP_REGEX = "/[^self::INSTRUCTION_ADVANCE + self::INSTRUCTION_TURN_RIGHT + self::INSTRUCTION_TURN_LEFT]/";

  // position of our Robot on the grid
  public array $position;
  // direction of our Robot its facing to
  public int $direction;

  /**
   * Constructor.
   *
   * @param array $position x and y coordinates on the grid.
   * @param int $direction the direction the robot is facing to.
   * @return void
   */
  function __construct(array $position, int $direction)
  {
    $this->position = $position;
    $this->direction = $direction;
  }

  /**
   * Robot turns right once in direction.
   *
   * @return Robot
   */
  function turnRight(): Robot
  {
    switch ($this->direction) {
      case self::DIRECTION_NORTH:
      case self::DIRECTION_EAST:
      case self::DIRECTION_SOUTH:
        $this->direction++;
        break;
      case self::DIRECTION_WEST:
        $this->direction = self::DIRECTION_NORTH;
        break;
      default:
        // do nothing
    }

    return $this;
  }

  /**
   * Robot turns left once in direction.
   *
   * @return Robot
   */
  function turnLeft(): Robot
  {
    switch ($this->direction) {
      case self::DIRECTION_NORTH:
        $this->direction = self::DIRECTION_WEST;
        break;
      case self::DIRECTION_EAST:
      case self::DIRECTION_SOUTH:
      case self::DIRECTION_WEST:
        $this->direction--;
        break;
      default:
        // do nothing
    }

    return $this;
  }

  /**
   * Robot moves one step forward in its direction.
   *
   * @return Robot
   */
  function advance(): Robot
  {
    list($x, $y) = $this->position;

    switch ($this->direction) {
      case self::DIRECTION_NORTH:
        $y++;
        break;
      case self::DIRECTION_EAST:
        $x++;
        break;
      case self::DIRECTION_SOUTH:
        $y--;
        break;
      case self::DIRECTION_WEST:
        $x--;
        break;
      default:
        // do nothing
    }

    $this->position = [$x, $y];

    return $this;
  }

  /**
   * Set instructions to move or turn the robot.
   *
   * @param string $steps Set of characters. Only 'L', 'R' or 'A' are allowed.
   *
   * @return void
   * @throws IllegalArgumentException
   */
  function instructions(string $steps): void
  {
    if ($this->hasInvalidInstruction($steps))
      throw new InvalidArgumentException("Unknown instruction set. Only 'L', 'R' or 'A' are allowed.");

    $listOfInstructions = str_split($steps);
    foreach ($listOfInstructions as &$currStep) {
      switch ($currStep) {
        case self::INSTRUCTION_ADVANCE:
          $this->advance();
          break;
        case self::INSTRUCTION_TURN_LEFT:
          $this->turnLeft();
          break;
        case self::INSTRUCTION_TURN_RIGHT:
          $this->turnRight();
          break;
        default:
          // do nothing
      }
    }
    unset($currStep);
  }

  /**
   * Check if there are invalid instructions.
   * Following instrunction values are allowed:
   * <br>self::INSTRUCTION_ADVANCE
   * <br>self::INSTRUCTION_TURN_LEFT
   * <br>self::INSTRUCTION_TURN_RIGHT
   *
   * @param string $steps instruction steps.
   *
   * @return bool Returns `true` if expression is invalid, else `false`.
   */
  function hasInvalidInstruction(string $steps): bool
  {
    return preg_match(self::UNKNOWN_STEP_REGEX, $steps);
  }

  /**
   * Destructor.
   *
   * @return void
   */
  function __destruct()
  {
    unset($this->position);
    unset($this->direction);
  }
}
