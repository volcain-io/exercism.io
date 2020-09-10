#!/usr/bin/env bash

declare -A cipher_map=(
  [a]=z [b]=y [c]=x [d]=w
  [e]=v [f]=u [g]=t [h]=s
  [i]=r [j]=q [k]=p [l]=o
  [m]=n [n]=m [o]=l [p]=k
  [q]=j [r]=i [s]=h [t]=g
  [u]=f [v]=e [w]=d [x]=c
  [y]=b [z]=a
)

remove_none_alnum() {
  # Usage: remove_none_alnum <string>
  echo "${1//[^[:alnum:]]/}"
}

group_letters() {
  # Usage: group_letters <string>
  local output="${1:0:5}"

  for (( idx=5; idx<${#1}; idx+=5 )); do
    (( idx%5 == 0 )) && output+=" ${1:idx:5}"
  done

  echo "${output}"
}

atbash() {
  # Usage: atbash <string>
  local output

  for (( idx=0; idx<${#1}; idx++ )); do
    letter=${1:idx:1}
    output+="${cipher_map[${letter}]-${letter}}"
  done

  echo "${output}"
}

usage() {
    printf "Usage: atbash_cipher.sh [OPTION] [STRING]\n\n"
    printf "OPTIONS:\n"
    printf "   encode\n"
    printf "\tEncode given string.\n"
    printf "   decode\n"
    printf "\tDecode given string.\n"
    printf "ARGS:\n"
    printf "   <STRING>\n"
    printf "\tString to encode/decode.\n"
}

main () {
  if (( "$#" != 2 )) || [[ "$1" != "encode" && "$1" != "decode" ]]; then
    usage
    exit 1
  fi

  local -lr option="$1"
  local -lr input=$(remove_none_alnum "$2")
  local output

  output="$(atbash "${input}")"

  case "${option}" in
    'encode')
      output=$(group_letters "${output}")
      ;;
  esac

  echo "${output}"
}

main "$@"
