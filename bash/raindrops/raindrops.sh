#!/usr/bin/env bash

main() {
  local num="${1}"
  local -a map=( [3]="Pling" [5]="Plang" [7]="Plong" )

  for factor in "${!map[@]}"; do
    if (( num%factor == 0 )); then
      result+="${map[$factor]}"
    fi
  done

  echo ${result:-${num}}
}

main "$@"
