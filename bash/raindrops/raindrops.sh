#!/usr/bin/env bash

main() {
  local num="${1}"

  (( ${num}%3 == 0 )) && result="Pling"
  (( ${num}%5 == 0 )) && result+="Plang"
  (( ${num}%7 == 0 )) && result+="Plong"

  echo ${result:-${num}}
}

main "$@"
