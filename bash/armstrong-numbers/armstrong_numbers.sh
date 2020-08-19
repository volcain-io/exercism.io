#!/usr/bin/env bash

sum_digits() {
  # Usage: sum_digits <integer>
  local -ir len="${#1}"
  local -i sum
  for (( i = 0; i < "${len}"; i++ ));do
    (( sum+="${1:i:1}" ** len ))
  done
  echo "${sum}"
}

main () {
  if [[ "$#" -ne 1 ]]; then
    echo "Usage: armstrong_number.sh <integer>"
    return 1
  fi

  local sum

  sum="$(sum_digits "$1")"
  if (( "${sum}" == "${1}" )); then
    echo "true"
  else
    echo "false"
  fi
}

main "$@"
