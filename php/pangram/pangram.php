<?php

define("ENGLISH_ALPHABET_LENGTH", 26);

function isPangram(string $sentence = ""): bool {
  $string = preg_replace('/[^a-z]/u', '', mb_strtolower($sentence));

  return count(count_chars($string, 1)) === ENGLISH_ALPHABET_LENGTH;
}
