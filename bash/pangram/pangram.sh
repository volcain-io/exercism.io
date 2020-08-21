#!/usr/bin/env bash

letter_counter() {
  # Usage: letter_counter <string>
  local -A chars=()
  local -l lowercase="${1}"

  for (( i = 0; i < "${#lowercase}"; i++ )); do
    ch=${lowercase:i:1}
    if [[ "${ch}" =~ [a-z] ]]; then
      chars["${ch}"]=1
    fi
  done

  echo "${#chars[*]}"
}

main () {
  if [[ "$#" != 1 ]]; then
    echo "Usage: pangram.sh <sentence>"
  fi

  local -i max_letters=26
  local -i count

  count=$(letter_counter "${1}")

  if (( "${count}" == "${max_letters}" )); then
    echo "true"
  else
    echo "false"
  fi
}

main "$@"
