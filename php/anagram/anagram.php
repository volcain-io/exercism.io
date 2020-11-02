<?php
/**
 * Given a word and a list of possible anagrams, select the correct sublist.
 *
 * @param string $word Any string.
 * @param array $listOfWords List of possible anagrams.
 *
 * @return array Sublist of correct anagrams (can be empty if no correct anagram is found).
 */
function detectAnagrams(string $word, array $listOfWords): array
{
  $output = [];

  $characterList = mb_str_split(mb_strtolower($word));
  sort($characterList);
  $alphaSort = implode($characterList);

  foreach ($listOfWords as $value) {
    // skip equal words
    if (strcasecmp($word, $value) == 0) {
      continue;
    }

    $anagramCharacterList = mb_str_split(mb_strtolower($value));
    sort($anagramCharacterList);
    $anagramAlphaSort = implode($anagramCharacterList);

    if (!array_key_exists($value, $output) && $alphaSort === $anagramAlphaSort) {
      $output[$value] = TRUE;
    }
  }

  return array_keys($output);
}
