#!/usr/bin/env bash

remove_all_whitespace() {
  # Usage: remove_all_whitespace "phrase"
  echo "${1//[[:space:]]/}"
}

is_yelling_question() {
  # Usage: is_yelling_question "phrase"
  is_question "$1" && is_yelling "$1"
}

is_yelling() {
  # Usage: is_yelling "phrase"
  [[ "$1" =~ [A-Z] && "${1^^}" == "${1}" ]]
}

is_question() {
  # Usage: is_question "phrase"
  [[ "${1}" == *"?" ]]
}

is_mute() {
  # Usage: is_mute "phrase"
  [[ -z "$1" ]]
}

main () {
  non_whitespace_phrase=$(remove_all_whitespace "$1")

  if is_yelling_question "${non_whitespace_phrase}"; then
    echo "Calm down, I know what I'm doing!"
  elif is_yelling "${non_whitespace_phrase}"; then
    echo "Whoa, chill out!"
  elif is_question "${non_whitespace_phrase}"; then
    echo "Sure."
  elif is_mute "${non_whitespace_phrase}"; then
    echo "Fine. Be that way!"
  else
    echo "Whatever."
  fi
}

main "$@"
