#!/usr/bin/env bash

main() {
  name=$1

  if (( "$#" != 1 )); then
    echo "Usage: error_handling.sh <person>"
    return 1
  fi

  echo "Hello, ${name}"
  return "$?"
}

main "$@"
