function replacer(match) {
  const alphabet = 'abcdefghijklmnopqrstuvwxyz';

  const index = alphabet.indexOf(match.toLowerCase());

  if (index > -1) {
    return alphabet[alphabet.length - index - 1];
  }

  return match;
}

export function encode(value = '') {
  const clean = value.replace(/[^a-z0-9]+/gi, '');
  const replacement = clean.replace(/(.)\1*/gi, replacer);

  let result = replacement;
  if (result.length > 5) {
    return result.split('').map((elem, idx) => {
      return (idx+1) % 5 ? elem : `${elem} `;
    }).join('').trim();
  }

  return replacement;
}
