<?php

/**
 * Translate from English to Pig Latin.
 *
 * @param string $words The english words to translate, seperated by a single whitspace.
 *
 * @return string The result in Pig Latin.
 */
function translate(string $words = ""): string
{
  $listOfWords = mb_split(" ", $words);
  foreach ($listOfWords as &$word) {
    $word = beginsWithVowelSounds($word) ? applyRule1($word) : applyRule2($word);
  }
  unset($word);

  return implode(" ", $listOfWords);
}

/**
 * Check, if given word starts with a vowel sound.
 *
 * @param string $word The string to check.
 *
 * @return bool `true` if word starts with vowel sound, else `false`.
 */
function beginsWithVowelSounds(string $word = ""): bool
{
  return preg_match('/^([aeiou]|(x|y)[^aeiou])/', $word);
}

/**
 * Applies rule 1 to given word
 * Rule 1: If a word begins with a vowel sound, add an "ay" sound to the end of the word.
 *
 * @param string $word The string to apply the rule to.
 *
 * @return string The result as a string.
 */
function applyRule1(string $word = ""): string
{
  return $word . "ay";
}

/**
 * Applies rule 2 to given word
 * Rule 2: If a word begins with a consonant sound, move it to the end of the word, and then add an "ay" sound to the end of the word.
 *
 * @param string $word The string to apply the rule to.
 *
 * @return string The result as a string.
 */
function applyRule2(string $word = ""): string
{
  // we have some special cases, which we have to consider
  $idx = 1;
  // The letters "ch", "qu", "th", "xr" belong together
  if (preg_match('/^(ch|qu|th|xr)/i', $word)) $idx = 2;
  // The letters "sch", "[^a-z]qu" belong together
  if (preg_match('/^(sch|thr|[^aeiou]qu)/i', $word)) $idx = 3;

  $prefix = mb_substr($word, 0, $idx);
  $restOfWord = mb_substr($word, $idx);

  return $restOfWord . $prefix . "ay";
}
