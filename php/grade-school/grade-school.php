<?php

class School
{
  private array $roster;

  /**
   * Constructor.
   */
  public function __construct()
  {
    $this->roster = [];
  }

  /**
   * Add a new student to the roster.
   *
   * @param string $name Name of the student.
   * @param int $grade Grade of the student.
   *
   */
  public function add(string $name, int $grade): void
  {
    $this->roster[$grade][] = $name;
  }

  /**
   * List all students name of given grade.
   *
   * @param int $grade The grade to look for students.
   *
   * @return array A list of strings.
   */
  public function grade(int $grade): array
  {
    if (array_key_exists($grade, $this->roster))
      return $this->roster[$grade];
    return [];
  }

  /**
   * List of sorted roster by grade and students name.
   *
   * @return array A sorted list.
   */
  public function studentsByGradeAlphabetical(): array
  {
    return $this->sortByGradeAndStudentsName();
  }

  /**
   * Sort roster by grade and students name (ascending).
   *
   * @return array A sorted list.
   */
  private function sortByGradeAndStudentsName(): array
  {
    $tmp = $this->roster;
    foreach (array_keys($tmp) as $grade) {
      sort($tmp[$grade]);
    }
    ksort($tmp);

    return $tmp;
  }
}
