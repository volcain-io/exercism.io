#!/usr/bin/env bash

declare -rA score_table=(
  [a]=1 [b]=3 [c]=3
  [d]=2 [e]=1 [f]=4
  [g]=2 [h]=4 [i]=1
  [j]=8 [k]=5 [l]=1
  [m]=3 [n]=1 [o]=1
  [p]=3 [q]=10 [r]=1
  [s]=1 [t]=1 [u]=1
  [v]=4 [w]=4 [x]=8
  [y]=4 [z]=10
)

main () {
  if [[ "$#" != 1 ]]; then
    echo "Usage: scrabble-score.sh <word>"
    return 1
  fi

  local -rl lowercase="${1}"
  local -i count=0

  for (( i = 0; i < "${#lowercase}"; i++ )); do
    ch=${lowercase:i:1}
    (( count+="${score_table[$ch]:-0}" ))
  done

  echo "${count}"
}

main "$@"
