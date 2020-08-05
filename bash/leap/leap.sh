#!/usr/bin/env bash

main() {
  year=$1

  if [[ "$#" -ne 1 || ${year} =~ [a-zA-Z] || ${year} =~ [\-?\d+\.\d*] ]]; then
    echo "Usage: leap.sh <year>"
    exit 1
  elif [[ ${year}%4 -eq 0 && ( ${year}%100 -gt 0 || ${year}%400 -eq 0 ) ]]; then
    echo "true"
  else
    echo "false"
  fi

  exit 0
}

main "$@"
