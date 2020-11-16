<?php

/**
 * Extract-Transform-Load
 * Format old data to new data.
 *
 * @param array $arr The array to extract data from.
 *
 * @return array The result is the new data format.
 */
function transform(array $old = []): array {
  $new = [];

  foreach($old as $key => $values) {
    foreach($values as $value) {
      $new[strtolower($value)] = intval($key);
    }
  }

  return $new;
}
