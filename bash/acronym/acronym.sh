#!/usr/bin/env bash

main () {
  if [[ "$#" -eq 0 ]]; then
    echo "Usage: acronym.sh <long name>"
    return 1
  fi

  replace_hiphen="${1//-/ }"
  alpha_only="${replace_hiphen//[[:punct:]]/}"
  read -r -a words <<< "${alpha_only}"

  for word in "${words[@]}"; do
    acronym+="${word:0:1}"
  done

  echo ${acronym^^}
}

main "$@"
