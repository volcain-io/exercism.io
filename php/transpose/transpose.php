<?php

/**
 * Transpose each value of given array, so that rows become columns and columns become rows.
 *
 * @param array $array The array to transpose.
 *
 * @return array The transposed array.
 */
function transpose(array $array = []): array
{
  $matrixArray = [];

  $numOfKeys = count($array);
  $lengthOfLongestValue = getLengthOfLongestValue($array);
  $paddedArray = padValuesToEqualLength($array, $lengthOfLongestValue);

  if ($lengthOfLongestValue === 0)
    return $array;

  for ($idx = 0; $idx < $lengthOfLongestValue; $idx++) {
    for ($jdx = 0; $jdx < $numOfKeys; $jdx++) {
      if (isset($matrixArray[$idx]))
        $matrixArray[$idx] .= $paddedArray[$jdx][$idx];
      elseif (isset($paddedArray[$jdx][$idx]))
        $matrixArray[$idx] = $paddedArray[$jdx][$idx];
    }
  }
  $matrixArray[$lengthOfLongestValue - 1] = rtrim($matrixArray[$lengthOfLongestValue - 1]);

  return $matrixArray;
}

/**
 * Get the lengths of the longest value inside given array.
 *
 * @param array $array The array to deterimine the longest value of.
 *
 * @return int The length of the longest value.
 */
function getLengthOfLongestValue(array $array = []): int
{
  return max(array_map('mb_strlen', $array));
}

/**
 * Pad all values of given array to given length.
 *
 * @param array $array The array to pad the values of.
 *
 * @return array The array with the padded values.
 */
function padValuesToEqualLength(array $array, int $len): array
{
  return array_map(function ($val) use ($len) {
    return str_pad($val, $len);
  }, $array);
}
