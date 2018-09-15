#!/usr/bin/env bash

# This is a bash script template in order to help you quick start any script.
# It contains some sensible defaults, you can learn more by visiting:
# https://google.github.io/styleguide/shell.xml

# Exit when there is an error
set -o errexit
# Exit when it tries to use an unset variable
set -o nounset
# Print command traces before executing command
# set -o xtrace

main() {
  square=$1

  # Add your code here
  if [[ "${square}" = "total" ]]; then
    total=0
    for exponent in {0..63}
    do
      power="$(printf '%u' $(( 2**exponent )))"
      total="$(printf '%u' $(( total+power )))"
    done
    echo $total
    exit 0
  elif [[ ${square} -ge 1 && ${square} -le 64 ]]; then
    printf '%u' $(( 2**(square-1) ))
    exit 0
  else
    echo "Error: invalid input"
    exit 1
  fi
}

# Calls the main function passing all the arguments to it via '$@'
# The argument is in quotes to prevent whitespace issues
main "$@"
