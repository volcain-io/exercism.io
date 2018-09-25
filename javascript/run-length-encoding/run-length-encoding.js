export function encode(param) {
  let encoding = '';

  if (param) {
    param.match(/(.)\1*/g).forEach((fullMatch) => {
      const len = fullMatch.length;
      const ch = fullMatch[0];
      encoding += len === 1 ? ch : `${len + ch}`;
    });
  }

  return encoding;
}

export function decode(param) {
  let result = '';
  let tmp = '';

  if (param) {
    param.split('').forEach((ch) => {
      if (Number(ch)) {
        tmp += `${ch}`;
      } else {
        result += tmp ? ch.repeat(Number(tmp)) : ch;
        tmp = '';
      }
    });
  }

  return result;
}
