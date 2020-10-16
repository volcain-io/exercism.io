<?php

final class Robot
{
  // possible values for the robot name prefix
  private const UPPERCASE_LETTERS = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';
  // possible values for the robot name postfix
  private const MIN_VALUE = 100;
  private const MAX_VALUE = 999;

  private $name;
  private static $listOfUniqueNames = [];

  /**
   * Constructor.
   *
   * @return void
   */
  function __construct()
  {
    $this->setName($this->createUniqueName());
  }

  /**
   * Get name of robot.
   *
   * @return string
   */
  public function getName(): string
  {
    return $this->name;
  }

  /**
   * Wipe the name of the robot and create a new unique name.
   *
   * @return void
   */
  public function reset(): void
  {
    $this->name = NULL;
    $this->setName($this->createUniqueName());
  }

  /**
   * Set name of robot and add name to list of unique names.
   *
   * @param string $name Name of robot.
   *
   * @return void
   */
  private function setName(string $name): void
  {
    $this->name = $name;
    self::addNameToList($name);
  }

  /**
   * Add name to list of unique names. The name will be add to the existing array as key,
   * which means any existing key will be overriden. The value of the key is set to `true`.
   *
   * @param string $name Name of robot to add.
   *
   * @return void
   */
  private static function addNameToList(string $name): void
  {
    self::$listOfUniqueNames[$name] = true;
  }

  /**
   * Check if name is already existing.
   *
   * @param string $name Name of robot to check.
   *
   * @return bool
   */
  private static function isNameExisting(string $name): bool
  {
    return isset(self::$listOfUniqueNames[$name]);
  }

  /**
   * Create unique robot name with a format of two uppercase letters
   * followed by three digits, such as RX837 or BC811.
   *
   * @return string
   */
  private function createUniqueName(): string
  {
    $randomName = substr(str_shuffle(self::UPPERCASE_LETTERS), -2) . random_int(self::MIN_VALUE, self::MAX_VALUE);

    return self::isNameExisting($randomName) ? $this->createUniqueName() : $randomName;
  }

  /**
   * Destructor.
   *
   * @return void
   */
  function __destruct()
  {
    unset($this->name);
  }
}
