#!/usr/bin/env bash

main () {
  if [[ "$#" != 1 ]]; then
    echo "Usage: scrabble-score.sh <word>"
    return 1
  fi

  local -rl lowercase="${1}"
  local -i sum=0

  for (( i = 0; i < "${#lowercase}"; i++ )); do
    case ${lowercase:i:1} in
      [aeilnorstu])
        (( sum+=1 ))
        ;;
      [dg])
        (( sum+=2 ))
        ;;
      [bcmp])
        (( sum+=3 ))
        ;;
      [fhvwy])
        (( sum+=4 ))
        ;;
      [k])
        (( sum+=5 ))
        ;;
      [jx])
        (( sum+=8 ))
        ;;
      [qz])
        (( sum+=10 ))
        ;;
      *)
        (( sum+=0 ))
    esac
  done

  echo "${sum}"
}

main "$@"
