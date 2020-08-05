#!/usr/bin/env bash

main () {
  COLORS=("black" "brown" "red" "orange" "yellow" "green" "blue" "violet" "grey" "white")
  args=(${@:1:2})

  output=""

  for arg in "${args[@]}"; do
    for idx in "${!COLORS[@]}"; do
      if [[ ${arg} == ${COLORS[$idx]} ]]; then
        output="$(printf '%s' "${output}${idx}")"
      fi
    done
  done

  if [ -z $output ]; then
    echo "invalid color"
    exit 1
  fi

  echo $output
  exit 0
}

main "$@"
