<?php

/**
 * Count the occurrences of each word in the given phrase.
 *
 * @param string $phrase Any string
 *
 * @return array List of words with count of their occurences.
 */
function wordCount(string $phrase): array
{
  $cleanPhrase = preg_replace('/[^a-zA-Z0-9]+/', ' ', strtolower($phrase));
  $listOfWords = explode(" ", trim($cleanPhrase));
  $output = [];

  foreach ($listOfWords as $value) {
    if (array_key_exists($value, $output)) {
      $output[$value] += 1;
    } else {
      $output[$value] = 1;
    }
  }

  return $output;
}
