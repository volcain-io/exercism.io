#!/usr/bin/env bash

main () {
  (( "$#" != 2 )) && {
    echo "Usage: hamming.sh <string1> <string2>"
    return 1
  }

  local string1="${1}"
  local string2="${2}"

  (( ${#string1} != ${#string2} )) && {
    echo "left and right strands must be of equal length"
    return 1
  }

  [[ "${string1}" == "${string2}" ]] && {
    echo "0"
    return 0
  }

  for (( i=0; i<${#string1}; i++ )); do
    [[ "${string1:$i:1}" != "${string2:$i:1}" ]] && diff+=${string2:$i:1}
  done

  echo "${#diff}"
}

main "$@"
