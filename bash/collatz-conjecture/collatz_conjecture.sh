#!/usr/bin/env bash

main () {
  num=$1

  if [[ ${num} -le 0 ]]; then
    echo "Error: Only positive numbers are allowed"
    exit 1
  fi

  count=0

  while [[ ${num} -gt 1 ]]; do
    if [[ ${num}%2 -eq 0 ]]; then
      num="$(printf '%u' $(( num/2 )))"
    else
      num="$(printf '%u' $(( 3*num+1 )))"
    fi
    count="$(printf '%u' $(( count+1 )))"
  done

  echo $count
  exit 0
}

main "$@"
