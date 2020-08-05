#!/usr/bin/env bash

main () {
  planet=${1:-"Earth"}
  seconds="${2}"
  earth_years=1

  case ${planet} in
    "Earth") earth_years=1;;
    "Jupiter") earth_years=11.862615;;
    "Mars") earth_years=1.8808158;;
    "Mercury") earth_years=0.2408467;;
    "Neptune") earth_years=164.79132;;
    "Saturn") earth_years=29.447498;;
    "Uranus") earth_years=84.016846;;
    "Venus") earth_years=0.61519726;;
    *) echo "not a planet"; exit 1;;
  esac

  awk "BEGIN { printf \"%.2f\",${seconds}/31557600/${earth_years};exit(0)}"
}

main "$@"
