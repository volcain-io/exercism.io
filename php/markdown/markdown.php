<?php

function parseMarkdown($markdown)
{
  $lines = explode("\n", $markdown);

  foreach ($lines as &$line) {
    createHeaders($line);
    createUnorderedListItem($line);
    createParagraph($line);
    createBold($line);
    createItalic($line);
  }
  createUnorderedList($lines);

  return join($lines);
}

function createHeaders(string &$line = '')
{
  if (preg_match("/^######(.*)/", $line, $matches)) {
    $line = "<h6>" . trim($matches[1]) . "</h6>";
  } elseif (preg_match("/^##(.*)/", $line, $matches)) {
    $line = "<h2>" . trim($matches[1]) . "</h2>";
  } elseif (preg_match("/^#(.*)/", $line, $matches)) {
    $line = "<h1>" . trim($matches[1]) . "</h1>";
  }
}

function createBold(string &$line): bool
{
  if (preg_match('/(.*)__(.*)__(.*)/', $line, $matches)) {
    $line = $matches[1] . '<em>' . $matches[2] . '</em>' . $matches[3];
    return true;
  }
  return false;
}

function createItalic(string &$line): bool
{
  if (preg_match('/(.*)_(.*)_(.*)/', $line, $matches)) {
    $line = $matches[1] . '<i>' . $matches[2] . '</i>' . $matches[3];
    return true;
  }
  return false;
}

function createParagraph(string &$line): bool
{
  if (!preg_match('/<h|<ul|<p|<li/', $line)) {
    $line = "<p>$line</p>";
    return true;
  }
  return false;
}

function createUnorderedListItem(string &$line): bool
{
  if (preg_match('/\*(.*)/', $line, $matches)) {
    $isBold = createBold($matches[1]);
    $isItalic = createItalic($matches[1]);

    if ($isItalic || $isBold) {
      $line = "<li>" . trim($matches[1]) . "</li>";
    } else {
      $line = "<li><p>" . trim($matches[1]) . "</p></li>";
    }
    return true;
  }
  return false;
}

function createUnorderedList(array &$lines): bool
{
  $unorderedList = array_filter($lines, function ($val) {
    $start = substr($val, 0, 4);
    $end = substr($val, -5);
    if ($start === '<li>' && $end === '</li>')
      return $val;
  });
  if (count($unorderedList) > 0) {
    $unorderedList[array_key_first($unorderedList)] = '<ul>' . $unorderedList[array_key_first($unorderedList)];
    $unorderedList[array_key_last($unorderedList)] = $unorderedList[array_key_last($unorderedList)] . '</ul>';
    $lines = array_replace($lines, $unorderedList);
    return true;
  }
  return false;
}
