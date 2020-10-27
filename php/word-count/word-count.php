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
  return array_count_values(str_word_count(strtolower($phrase), 1, '0..9'));
}
