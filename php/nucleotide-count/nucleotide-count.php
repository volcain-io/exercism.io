<?php

/**
 * Compute how many times each nucleotide occurs in the string.
 *
 * @param string $string The string to search in.
 *
 * @return array The result contains the amount of times each nucleotide occurs.
 */
function nucleotideCount(string $string = ""): array {
  $trimmed = trim(strtoupper($string));

  return [
    'a' => substr_count($trimmed, 'A'),
    'c' => substr_count($trimmed, 'C'),
    't' => substr_count($trimmed, 'T'),
    'g' => substr_count($trimmed, 'G'),
  ];
}
