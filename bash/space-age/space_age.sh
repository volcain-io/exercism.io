#!/usr/bin/env bash

declare -r EARTH_YEAR_IN_SECONDS=31557600
declare -rA PLANET_EARTH_YEARS=( [Earth]=1 [Jupiter]=11.862615 [Mars]=1.8808158 [Mercury]=0.2408467 [Neptune]=164.79132 [Saturn]=29.447498 [Uranus]=84.016846 [Venus]=0.61519726)

calculate_age() {
  # Usage: calculate_age <planet> <seconds>
  planet="${1}"
  seconds="${2}"

  awk "BEGIN { printf \"%.2f\",${seconds}/${EARTH_YEAR_IN_SECONDS}/${PLANET_EARTH_YEARS[${planet}]};exit(0)}"
}

main () {
  if [[ "$#" != 2 ]]; then
    echo "Usage: space-age.sh <planet> <seconds>"
  fi

  if ! [[ "${PLANET_EARTH_YEARS[${1}]}" ]]; then
    echo "not a planet"
    return 1
  fi

  calculate_age "${1}" "${2}"
}

main "$@"
