#!/usr/bin/env bash

main () {
  (( "$#" != 2 )) && {
    echo "Usage: hamming.sh <string1> <string2>"
    return 1
  }

  if (( ${#1} != ${#2} )); then
    echo "left and right strands must be of equal length"
    return 1
  fi

  local diff=0
  for (( i = 0; i < ${#1}; i++ )); do
    if [[ "${1:$i:1}" != "${2:$i:1}" ]]; then
      diff=$((diff + 1))
    fi
  done

  echo "${diff}"
}

main "$@"
