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
      'a'|'e'|'i'|'l'|'n'|'o'|'r'|'s'|'t'|'u')
        (( sum+=1 ))
        ;;
      'd'|'g')
        (( sum+=2 ))
        ;;
      'b'|'c'|'m'|'p')
        (( sum+=3 ))
        ;;
      'f'|'h'|'v'|'w'|'y')
        (( sum+=4 ))
        ;;
      'k')
        (( sum+=5 ))
        ;;
      'j'|'x')
        (( sum+=8 ))
        ;;
      'q'|'z')
        (( sum+=10 ))
        ;;
      *)
        (( sum+=0 ))
    esac
  done

  echo "${sum}"
}

main "$@"
