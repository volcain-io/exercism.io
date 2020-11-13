<?php

class Bob
{
  /**
   * Create response to a given phrase (question, yelling, mute or yelling question).
   *
   * @param string $phrase Any string.
   *
   * @return string Response to phrase
   * - if $phrase is a yelling question respond "Calm down, I know what I'm doing"
   * - if $phrase is a yelling phrase respond "Whoa, chill out!"
   * - if $phrase is a question respond "Sure."
   * - if $phrase is a mute phrase respond "Fine. Be that way!"
   * - if $phrase is none of above respond "Whatever."
   */
  public function respondTo(string $phrase = ""): string
  {
    $nonWhitespacePhrase = $this->removeAllWhitespace($phrase);

    if ($this->isYellingQuestion($nonWhitespacePhrase))
      return "Calm down, I know what I'm doing!";
    else if ($this->isYelling($nonWhitespacePhrase))
      return "Whoa, chill out!";
    else if ($this->isQuestion($nonWhitespacePhrase))
      return "Sure.";
    else if ($this->isMute($nonWhitespacePhrase))
      return "Fine. Be that way!";
    else
      return "Whatever.";
  }

  /**
   * Removes all whitespace characters.
   *
   * @param string $string Any string.
   *
   * @return string
   */
  private function removeAllWhitespace(string $string = ""): string
  {
    return preg_replace('/[[:space:]]/u', '', $string);
  }

  /**
   * Check, if given string is a yelling phrase AND a question,
   * e.g. WHAT THE HELL WERE YOU THINKING?.
   *
   * @param string $string Any string.
   *
   * @return bool
   **/
  private function isYellingQuestion(string $string = ""): bool
  {
    return $this->isQuestion($string) && $this->isYelling($string);
  }

  /**
   * Check, if given phrase is yelling phrase, e.g. WATCH OUT!.
   *
   * @param string $string Any string.
   *
   * @return bool
   */
  private function isYelling(string $string = ""): bool
  {
    return preg_match('/[[:alpha:]]/u', $string) && mb_strtoupper($string) === $string;
  }

  /**
   * Check, if given phrase is a question,
   * e.g. Does this cryogenic chamber make me look fat?.
   *
   * @param string $string Any string.
   *
   * @return bool
   */
  private function isQuestion(string $string = ""): bool
  {
    return mb_substr($string, -1, 1) === "?";
  }

  /**
   * Check, if given phrase is empty.
   *
   * @param string $string Any string.
   *
   * @return bool
   */
  private function isMute(string $string = ""): bool
  {
    return empty(trim($string));
  }
}
