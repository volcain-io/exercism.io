<?php

function accumulate(array $input, callable $accumulator)
{
  $output = [];
  foreach ($input as $val) {
    $output[] = $accumulator($val);
  }
  return $output;
}
