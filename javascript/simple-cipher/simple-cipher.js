export class Cipher {
  constructor(key = this.generateKey()) {
    if (key.length === 0 || key.match(/[^a-z]/g)) throw new Error('Bad key');
    this.key = key;
  }

  generateKey() {
    let key = '';
    const min = 'a'.charCodeAt();
    const bound = 'z'.charCodeAt() - min + 1;

    while (key.length <= 100) {
      const rand = Math.floor(Math.random() * bound) + min;
      key += String.fromCharCode(rand);
    }

    return key;
  }

  encode(value) {
    return this._encrypt(value);
  }

  decode(value) {
    return this._encrypt(value, true);
  }

  _encrypt(value, reverse) {
    const min = 'a'.charCodeAt();
    return value.split('').map((ch, idx) => {
      let k = this.key[idx % this.key.length].charCodeAt();
      if (reverse) k = -k;
      return this._getCharAt((ch.charCodeAt() + k) % min);
    }).join('');
  }

  _getCharAt(charCode) {
    const min = 'a'.charCodeAt();
    const bound = 'z'.charCodeAt() - min + 1;
    if (charCode < 0) charCode += bound;
    if (charCode >= bound) charCode -= bound;
    return String.fromCharCode(charCode + min);
  }
}
