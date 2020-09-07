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

# Formula to calculate the (doubled) value of a single digit 'x':
#   ===> x = n * 2; if x > 9 then x = x - 9
# We can simplify the formula even further using modulo:
#   ===> if n < 9 then x = n * 2 % 9 else x = n
# So if we calculate 'x' for each digit (n < 9) with the formula above,
# we get following values for n=[0-8]:
#   n = 0 ==> 'x' = 0
#   n = 1 ==> 'x' = 2
#   ...
#   n = 8 ==> 'x' = 7
# So we can setup a map with the corresponding values of the doubled digits
# to retrieve our desired value. This means we do not need any math
# calculation to get the doubled digit. We can simply use the following index:
#   ===> ( 0: 0, 1: 2, 2: 4, 3: 6, 4: 8, 5: 1, 6: 3, 7: 5, 8: 7, 9: 9 )
luhn() {
  # Usage: luhn <string>
  local -i sum
  local -a doubleIndex=( 0 2 4 6 8 1 3 5 7 9 )

  # start reading from right to left, because we need every second digit from right
  for (( idx=${#1}-1; idx >= 0; idx-- )); do
    digit="${1:(-idx):1}"
    # get the doubled value of every second digit from right
    (( idx%2 == 0 )) && (( digit=doubleIndex[digit] ))
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

  sum="$(luhn "${stripped}")"

  evenly_divisible_by_ten "${sum}" && echo "true" || echo "false"
}

main "$@"
