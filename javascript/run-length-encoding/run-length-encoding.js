export function encode(param) {
  return param.replace(/(.)\1+/g, (match, letter) => match.length + letter);
}

export function decode(param) {
  return param.replace(/(\d+)(.)/g, (_, count, letter) => letter.repeat(count));
}
