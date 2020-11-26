<?php

/**
 * Markdown to HTML Parser.
 *
 * @param string $markdown The markdown to parse.
 *
 * @return string The parsed markdown as HTML.
 */
function parseMarkdown(string $markdown = ''): string
{
  $lines = explode("\n", $markdown);

  foreach ($lines as &$line) {
    createHeader($line);
    createListItem($line);
    createParagraph($line);
    createBoldAndItalicText($line);
  }
  createUnorderedList($lines);

  return join($lines);
}

/**
 * Create H1, H2 or H6 titles.
 *
 * @param string &$line The string to replace.
 *
 * @return void
 */
function createHeader(string &$line = ''): void
{
  $line = preg_replace('/^###### (.*)/u', '<h6>${1}</h6>', $line);
  $line = preg_replace('/^## (.*)/u', '<h2>${1}</h2>', $line);
  $line = preg_replace('/^# (.*)/u', '<h1>${1}</h1>', $line);
}

/**
 * Create <em></em> and <i></i> text.
 *
 * @param string &$line The string to replace.
 *
 * @return bool `true` on success, `false` on failure.
 */
function createBoldAndItalicText(string &$line): bool
{
  $bool = false;
  if (isBoldText($line)) {
    $line = preg_replace('/__(.*)__/u', '<em>${1}</em>', $line);
    $bool = true;
  }
  if (isItalicText($line)) {
    $line = preg_replace('/_(.*)_/u', '<i>${1}</i>', $line);
    $bool = true;
  }
  return $bool;
}

/**
 * Create <em></em> and/or <i></i> text.
 *
 * @param string &$line The string to replace.
 *
 * @return bool `true` on success, `false` on failure.
 */
function createParagraph(string &$line): bool
{
  if (preg_match('/^(?:(?!<h[1-6]>|<ul>|<li>|\#|\*).)*/u', $line, $matches)) {
    if (!(empty($matches[0]))) {
      $line = '<p>' . $line . '</p>';
      return true;
    }
  }
  return false;
}

/**
 * Create <li></li> item.
 *
 * @param string &$line The string to replace.
 *
 * @return bool `true` on success, `false` on failure.
 */
function createListItem(string &$line): bool
{
  if (preg_match('/\*(.*)/', $line, $matches)) {
    createBoldAndItalicText($matches[1]);

    $line = trim($matches[1]);
    if (!(isBoldText($line) || isItalicText(($line))))
      createParagraph($line);
    $line = '<li>' . $line . '</li>';

    return true;
  }
  return false;
}

/**
 * Create <ul></ul> list.
 *
 * @param string &$lines The string to replace.
 *
 * @return bool `true` on success, `false` on failure.
 */
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

/**
 * Check if given text is a bold text.
 *
 * @param string $line The string to check.
 *
 * @return bool `true` on success, `false` on failure.
 */
function isBoldText(string $line): bool
{
  return preg_match('/(__(.*)__|<em>(.*)<\/em>)/', $line);
}

/**
 * Check if given text is an italic text.
 *
 * @param string $line The string to check.
 *
 * @return bool `true` on success, `false` on failure.
 */
function isItalicText(string $line): bool
{
  return preg_match('/(_(.*)_|<i>(.*)<\/i>)/', $line);
}
