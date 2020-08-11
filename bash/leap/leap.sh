#!/usr/bin/env bash

main() {
  year="$1"

  if [[ "$#" -ne 1 || ${year} =~ [a-zA-Z] || ${year} =~ [\-?\d+\.\d*] ]]; then
    echo "Usage: leap.sh <year>"
    return 1
  fi

  if (( ${year}%4 == 0 && ${year}%100 > 0 || ${year}%400 == 0 )); then
    echo "true"
  else
    echo "false"
  fi

  return 0
}

main "$@"
