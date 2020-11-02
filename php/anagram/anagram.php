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

  $lower = mb_strtolower($word);
  $characterList = mb_str_split($lower);
  sort($characterList);
  $alphaSort = implode($characterList);

  foreach ($listOfWords as $value) {
    $anagramLower = mb_strtolower($value);

    // skip equal words
    if ($lower === $anagramLower) {
      continue;
    }

    $anagramCharacterList = mb_str_split($anagramLower);
    sort($anagramCharacterList);
    $anagramAlphaSort = implode($anagramCharacterList);

    if (!array_key_exists($value, $output) && $alphaSort === $anagramAlphaSort) {
      $output[$value] = TRUE;
    }
  }

  return array_keys($output);
}
