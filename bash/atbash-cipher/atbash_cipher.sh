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
    output+=" ${1:idx:5}"
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

encode() {
  # Usage: encode <string>
  group_letters "$(decode "$1")"
}

decode() {
  # Usage: decode <string>
  atbash "$1"
}

usage() {
    printf "Usage: %s [SUBCOMMAND] [STRING]\n\n" "${0##*/}"
    printf "SUBCOMMAND:\n"
    printf "   encode\n"
    printf "\tEncode given string.\n"
    printf "   decode\n"
    printf "\tDecode given string.\n"
    printf "ARGS:\n"
    printf "   <STRING>\n"
    printf "\tString to encode/decode.\n"
}

main () {
  case "$1" in
    encode|decode)
      "$1" "$(remove_none_alnum "${2,,}")"
      ;;
    *)
      usage
      exit 1
      ;;
  esac
}

main "$@"
