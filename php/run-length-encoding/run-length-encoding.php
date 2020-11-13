<?php

function encode(string $input = ""): string
{
  return preg_replace_callback(
    '/(.)\1+/',
    function ($matches) {
      return mb_strlen($matches[0]) . $matches[1];
    },
    $input
  );
}

function decode(string $input = ""): string
{
  return preg_replace_callback(
    '/(\d+)(.)/',
    function ($matches) {
      return str_repeat($matches[2], $matches[1]);
    },
    $input
  );
}
