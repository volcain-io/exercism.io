#!/usr/bin/env bash

main() {
  name=$1

  if (( "$#" -ne 1 )); then
    echo "Usage: error_handling.sh <person>"
    exit 1
  else
    echo "Hello, ${name}"
  fi

  exit 0
}

main "$@"
