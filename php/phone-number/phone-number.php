<?php

class PhoneNumberRegex
{
  const NON_DIGIT = '/[^[:digit:]]/u';
  const ALPHA = '/[[:alpha:]]/u';
  const PUNCTUATION = '/[\+\(\)\-\.\s]/iu';
  const INVALID_CHARACTERS = '/[^\+\(\)\-\.0-9\s]/iu';
  const NANP_FORMAT = '/.*([2-9]{1}[0-9]{2}).*([2-9]{1}[0-9]{2}).*([0-9]{4}).*/';
}

class PhoneNumberValidator
{
  private string $number;
  private array $errors;

  /**
   * Constructor.
   */
  public function __construct(string $number = "")
  {
    $this->number = $number;
    $this->errors = [];
  }

  /**
   * Check, if errors are present.
   *
   * @return `true` if errors are present, else `false`.
   */
  public function hasErrors(): bool
  {
    return count($this->errors) > 0;
  }

  /**
   * Return list of errors.
   *
   * @return array The list containing all errors.
   */
  public function getErrors(): array
  {
    return $this->errors;
  }

  /**
   * Validate length. Must be 10 or 11 characters.
   */
  public function validateLength()
  {
    $clean = preg_replace(PhoneNumberRegex::PUNCTUATION, "", $this->number);

    if (strlen($clean) < 10)
      $this->errors[] = "incorrect number of digits";
    if (strlen($clean) > 11)
      $this->errors[] = "more than 11 digits";
  }

  /**
   * Validate country code. Must be 1, if given.
   */
  public function validateCountryCode()
  {
    $clean = preg_replace(PhoneNumberRegex::NON_DIGIT, "", $this->number);

    if (strlen($clean) === 11 && $clean[0] !== "1")
      $this->errors[] = "11 digits must start with 1";
  }

  /**
   * Validate against letters.
   */
  public function validateLetters()
  {
    if (preg_match(PhoneNumberRegex::ALPHA, $this->number))
      $this->errors[] = "letters not permitted";
  }

  /**
   * Validate against punctuation.
   */
  public function validatePunctuations()
  {
    if (preg_match(PhoneNumberRegex::INVALID_CHARACTERS, $this->number))
      $this->errors[] = "punctuations not permitted";
  }

  /**
   * Validate area code. Area code must start with digits between 2 to 9.
   */
  public function validateAreaCode()
  {
    $this->validateLength();

    $clean = preg_replace(PhoneNumberRegex::NON_DIGIT, "", $this->number);
    $areaCode = substr($clean, 0, 3);
    if (strlen($clean) === 11)
      $areaCode = substr($clean, 1, 3);

    if ($areaCode[0] === "0")
      $this->errors[] = "area code cannot start with zero";
    if ($areaCode[0] === "1")
      $this->errors[] = "area code cannot start with one";
  }

  /**
   * Validate exchange code. Exchange code must start with digits between 2 to 9.
   */
  public function validateExchangeCode()
  {
    $this->validateLength();

    $clean = preg_replace(PhoneNumberRegex::NON_DIGIT, "", $this->number);
    $exchangeCode = substr($clean, 3, 3);
    if (strlen($clean) === 11)
      $exchangeCode = substr($clean, 4, 3);

    if ($exchangeCode[0] === "0")
      $this->errors[] = "exchange code cannot start with zero";
    if ($exchangeCode[0] === "1")
      $this->errors[] = "exchange code cannot start with one";
  }
}

class PhoneNumber
{
  private string $number;
  private PhoneNumberValidator $validator;

  /**
   * Constructor.
   *
   * @param string $number The number string.
   */
  public function __construct(string $number = "")
  {
    $this->validator = new PhoneNumberValidator($number);
    $this->setNumber($number);
  }

  /**
   * Set phone number.
   *
   * @param string $number The number to set.
   *
   * @return void
   *
   * @throws InvalidArgumentException If phone number is invalid.
   */
  public function setNumber(string $number): void
  {
    $this->validateNumber();

    if ($this->validator->hasErrors())
      throw new InvalidArgumentException($this->validator->getErrors()[0]);

    $this->number = $number;
  }

  /**
   * Get phone number containing only digits.
   *
   * @return string The result as a string.
   */
  public function number(): string
  {
    if (isset($this->number)) {
      preg_match(PhoneNumberRegex::NANP_FORMAT, $this->number, $matches);
      return "${matches[1]}${matches[2]}${matches[3]}";
    }
    return "";
  }

  /**
   * Validate phone number.
   *
   * @return void
   *
   * @throws InvalidArgumentException
   */
  private function validateNumber(): bool
  {
    $this->validator->validateLength();
    $this->validator->validateCountryCode();
    $this->validator->validateLetters();
    $this->validator->validatePunctuations();
    $this->validator->validateAreaCode();
    $this->validator->validateExchangeCode();

    return $this->validator->hasErrors();
  }
}
