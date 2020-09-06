#!/usr/bin/env bash

is_invalid_length() {
  # Usage: is_invalid_length <string>
  [[ "${#1}" -lt 2 ]]
}

is_non_digit() {
  # Usage: is_non_digit <string>
  [[ "$1" =~ [^[:digit:]] ]]
}

strip_any_whitespace() {
  # Usage: strip_any_whitespace <string>
  echo "${1//[[:space:]]/}"
}

evenly_divisible_by_ten() {
  # Usage: evenly_divisible_by_ten <number>
  (( "$1"%10 == 0 ))
}

calculate_sum() {
  # Usage: calculate_sum <string>
  local number
  local -i sum

  # we need every second digit, so make
  # length of given number even, if necessary
  number="$1"
  if (( "${#number}"%2 == 1 )); then
    number="0${number}"
  fi

  for (( idx=0; idx < "${#number}"; idx++ )); do
    digit="${number:idx:1}"
    # double every second digit
    (( idx%2 == 0 )) && (( digit*=2 ))
    # if doubled number is greater 9, then subtract 9
    (( digit > 9 )) && (( digit-=9 ))
    # sum all digits
    (( sum+=digit ))
  done

  echo "${sum:-0}"
}

main () {
  if [[ "$#" != 1 ]]; then
    echo "Usage: luhn.sh <number>"
    return 1
  fi

  local stripped
  stripped="$(strip_any_whitespace "$1")"

  if is_invalid_length "${stripped}" || is_non_digit "${stripped}"; then
    echo "false"
    return 0
  fi

  : "$(calculate_sum "${stripped}")"

  evenly_divisible_by_ten "$_" && echo "true" || echo "false"
}

main "$@"
