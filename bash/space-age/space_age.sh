#!/usr/bin/env bash

declare -ri EARTH_YEAR_IN_SECONDS=31557600
declare -rA PLANET_EARTH_YEARS=(
  [Earth]=1
  [Jupiter]=11.862615
  [Mars]=1.8808158
  [Mercury]=0.2408467
  [Neptune]=164.79132
  [Saturn]=29.447498
  [Uranus]=84.016846
  [Venus]=0.61519726
)

main () {
  if [[ "$#" != 2 ]]; then
    echo "Usage: space-age.sh <planet> <seconds>"
  fi

  if [[ -z "${PLANET_EARTH_YEARS[${1}]}" ]]; then
    echo "not a planet"
    return 1
  fi

  local -r planet="${1}"
  local -r seconds="${2}"

  expr="$seconds / ( $EARTH_YEAR_IN_SECONDS * ${PLANET_EARTH_YEARS[$planet]} )"
  printf '%.2f\n' "$(bc <<< "scale=3; ${expr}")"
}

main "$@"
