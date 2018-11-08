export class Cipher {
  constructor(key) {
    this.min = 'a'.charCodeAt();
    this.bound = 'z'.charCodeAt() - this.min + 1;
    this.key = key || this.generateKey();
    if (!/^[a-z]+$/.test(key)) throw new Error('Bad key');
  }

  generateKey() {
    return Array(100).fill('').map((ch) => { // eslint-disable-line no-unused-vars
      const rnd = Math.floor(Math.random() * this.bound) + this.min;
      return String.fromCharCode(rnd);
    }).join('');
  }

  encode(value) {
    return this.shift(value);
  }

  decode(value) {
    return this.shift(value, true);
  }

  shift(value, reverse) {
    return value.split('').map((ch, idx) => {
      let k = this.key[idx % this.key.length].charCodeAt();
      if (reverse) k = -k;
      return this.getCharAt((ch.charCodeAt() + k) % this.min);
    }).join('');
  }

  getCharAt(charCode) {
    let tmp = charCode;
    if (charCode < 0) tmp += this.bound;
    if (charCode >= this.bound) tmp -= this.bound;
    return String.fromCharCode(tmp + this.min);
  }
}
