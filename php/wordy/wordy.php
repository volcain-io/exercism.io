<?php

define("MATH_OP_ADDITION", "plus");
define("MATH_OP_SUBTRACTION", "minus");
define("MATH_OP_MULTIPLICATION", "multiplied");
define("MATH_OP_DIVISION", "divided");
define("MATH_OP_EXPONENTIAL", "raised");

/**
 * Parse and evaluate simple math word problems.
 *
 * @param string $wordProblem Simple math world problem.
 * Following word problems can be calculated:
 * - addition: e.g. What is 5 plus 13?
 * - subtraction: e.g. What is 7 minus 5?
 * - multiplication: e.g. What is 6 multiplied by 4?
 * - division: e.g. What is 25 divided by 5?
 * - multiple operations: e.g. What is 25 divided by 5 plus 5?
 * - exponentials: e.g. What is 2 raised to the 5th power?
 *
 * @throws InvalidArgumentException If the math word problem is invalid.
 *
 * @return int
 */
function calculate(string $wordProblem = ""): float
{
  $trimmed = trim($wordProblem);

  $regex = '/^What is.*(' . MATH_OP_ADDITION . '|' . MATH_OP_SUBTRACTION . '|' . MATH_OP_MULTIPLICATION . '|' . MATH_OP_DIVISION . '|' . MATH_OP_EXPONENTIAL . ').*\?$/';
  preg_match($regex, $trimmed, $matches);
  if (count($matches) === 0)
    throw new InvalidArgumentException('Invalid word problem.');

  return evalProblem(parseProblem($trimmed));
}

/**
 * Parse word problem and remove everything which is not need to evaluate the math expression.
 * Removes everything which is not a number or math word operator.
 *
 * @param string $wordProblem The math word problem
 *
 * @return array
 */
function parseProblem(string $wordProblem = ""): array
{
  $translations = array(
    'What is ' => '',
    'by ' => '',
    'to ' => '',
    'the ' => '',
    'power?' => '',
    '?' => '',
    'st ' => '',
    'nd ' => '',
    'rd ' => '',
    'th ' => '',
  );

  $strippedVersion = strtr(trim($wordProblem), $translations);
  return explode(" ", $strippedVersion);
}

/**
 * Evaluate the math word problem.
 *
 * @param array $mathChunks Chunks of the math problem, e.g. ["3", "plus", "4"]
 *
 * @return int Result of the math word problem
 */
function evalProblem(array $mathChunks = []): float
{
  $result = 0;

  if (count($mathChunks) >= 3) {
    $count = 0;
    while ($count < count($mathChunks)) {
      if ($count % 2 !== 0) {
        if ($count === 1)
          $result = $mathChunks[$count - 1];

        switch ($mathChunks[$count]) {
          case MATH_OP_ADDITION:
            $result += $mathChunks[$count + 1];
            break;
          case MATH_OP_SUBTRACTION:
            $result -= $mathChunks[$count + 1];
            break;
          case MATH_OP_MULTIPLICATION:
            $result *= $mathChunks[$count + 1];
            break;
          case MATH_OP_DIVISION:
            $result /= $mathChunks[$count + 1];
            break;
          case MATH_OP_EXPONENTIAL:
            $result **= $mathChunks[$count + 1];
            break;
        }
      }
      $count++;
    }
  }

  return $result;
}
