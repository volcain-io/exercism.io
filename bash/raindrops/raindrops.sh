#!/usr/bin/env bash

main() {
  local num="${1}"

  (( ${num}%3 == 0 )) && result="Pling"
  (( ${num}%5 == 0 )) && result+="Plang"
  (( ${num}%7 == 0 )) && result+="Plong"

  [[ -n ${result} ]] && {
    echo "$result"
    return 0
  }

  echo "$num"
}

main "$@"
