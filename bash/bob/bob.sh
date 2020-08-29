#!/usr/bin/env bash

trim() {
  # Usage: trim "phrase"
  : "${1#"${1%%[![:space:]]*}"}"
  : "${_%"${_##*[![:space:]]}"}"
  echo "$_"
}

is_yelling_question() {
  # Usage: is_yelling_question "phrase"
  if is_question "$1" && is_yelling "$1"; then
    return 0
  fi
  return 1
}

is_yelling() {
  # Usage: is_yelling "phrase"
  if [[ "$1" =~ [A-Z] && "${1^^}" == "${1}" ]]; then
    return 0
  fi
  return 1
}

is_question() {
  # Usage: is_question "phrase"
  if [[ "${1}" == *"?" ]]; then
    return 0
  fi
  return 1
}

is_mute() {
  # Usage: is_mute "phrase"
  if [[ -z "$1" ]]; then
    return 0
  fi
  return 1
}

main () {
  trimmed_phrase=$(trim "$1")

  if is_yelling_question "${trimmed_phrase}"; then
    echo "Calm down, I know what I'm doing!"
  elif is_yelling "${trimmed_phrase}"; then
    echo "Whoa, chill out!"
  elif is_question "${trimmed_phrase}"; then
    echo "Sure."
  elif is_mute "${trimmed_phrase}"; then
    echo "Fine. Be that way!"
  else
    echo "Whatever."
  fi
}

main "$@"
