<?php

/**
 * Given a name, return a string with the message: One for X, one for me.
 *
 * @param string $name The string to create the message with.
 *
 * @return string The result as string.
 */
function twoFer(string $name = "you"): string {
  return "One for ${name}, one for me.";
}
