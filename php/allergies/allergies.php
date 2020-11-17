<?php

class Allergen
{
  const CATS = 'cats';
  const CHOCOLATE = 'chocolate';
  const EGGS = 'eggs';
  const PEANUTS = 'peanuts';
  const POLLEN = 'pollen';
  const SHELLFISH = 'shellfish';
  const STRAWBERRIES = 'strawberries';
  const TOMATOES = 'tomatoes';

  private string $allergen;

  /**
   * Constructor.
   *
   * @param string $allergen The allergen.
   */
  public function __construct(string $allergen = "")
  {
    $this->allergen = $allergen;
  }

  /**
   * List of allergies. We use the key index to calculate the score of the allergy.
   *
   * @return array A list of possible allergies.
   */
  public static function allergenList(): array
  {
    return [
      self::EGGS, // 1
      self::PEANUTS, // 2
      self::SHELLFISH, // 4
      self::STRAWBERRIES, // 8
      self::TOMATOES, // 16
      self::CHOCOLATE, // 32
      self::POLLEN, // 64
      self::CATS, // 128
    ];
  }

  /**
   * Calculate the score of the allergy.
   * Following scores are possible:
   * - eggs (1)
   * - peanuts (2)
   * - shellfish (4)
   * - strawberries (8)
   * - tomatoes (16)
   * - chocolate (32)
   * - pollen (64)
   * - cats (128)
   *
   * @return int
   */
  public function getScore(): int
  {
    $filter = array_filter(Allergen::allergenList(), function ($allergen) {
      return $allergen === $this->allergen;
    });
    return 2 ** array_key_first($filter);
  }

  /**
   * String representation of the instance.
   *
   * @return string
   */
  public function __toString(): string
  {
    return $this->allergen;
  }
}

class Allergies
{
  private int $personAllergyScore;

  /**
   * Constructor.
   *
   * @param int $personAllergyScore The allergy score of all possible allergies of a person.
   */
  public function __construct(int $personAllergyScore = 0)
  {
    $this->personAllergyScore = $personAllergyScore;
  }

  /**
   * List of possible allergies according to a persons allergy score.
   *
   * @return array
   */
  public function getList(): array
  {
    return array_filter(Allergen::allergenList(), function ($allergen) {
      return $this->isAllergicTo($allergen);
    });
  }

  /**
   * Check, if a person is allergic to given allergy.
   *
   * @param Allergen|string $allergy The allergy to be checked against.
   *
   * @return bool `true` if the person is allergic to the allergy, else `false`.
   */
  public function isAllergicTo($allergy = ""): bool
  {
    if (is_string($allergy)) $allergy = new Allergen($allergy);
    $isInstanceOf = $allergy instanceof Allergen;

    return $isInstanceOf && boolval($this->personAllergyScore & $allergy->getScore());
  }
}
