#!/usr/bin/env bash

arg="${1:-""}"

main() {
  for (( idx=${#arg}; idx >= 0; idx-- )); do
    echo -n "${arg:$idx:1}"
  done
}

main