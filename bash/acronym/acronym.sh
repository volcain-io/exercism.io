#!/usr/bin/env bash

trim_quotes() {
  # Usage: trim_quotes "string"
  : "${1//\'}"
  echo -n "${_//\"}"
}

replace_all() {
  # Usage: replace_all "string" "pattern" "replacement"
  echo -n "${1//$2/$3}"
}

main () {
  if [[ "$#" -eq 0 ]]; then
    echo "Usage: acronym.sh <long name>"
    return 1
  fi

  no_quotes="$(trim_quotes "$1")"
  clean_string="$(replace_all "${no_quotes}" "[[:punct:]]" " ")"

  read -r -a words <<< "${clean_string}"

  for word in "${words[@]}"; do
    acronym+="${word:0:1}"
  done

  echo ${acronym^^}
}

main "$@"
