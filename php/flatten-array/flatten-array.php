<?php

/**
 * Flatten any nested list and return a single flattened list with all values except nil/null.
 *
 * @param array $input The nested list to flatten.
 *
 * @return array The result as a single flattened list.
 */
function flatten(array $input = []): array
{
  $result = [];
  $iterator = new RecursiveIteratorIterator(new RecursiveArrayIterator($input));
  foreach ($iterator as $value) {
    if (isset($value))
      $result[] = $value;
  }
  return $result;
}
