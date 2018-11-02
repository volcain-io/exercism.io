export function compute(leftStrand = '', rightStrand = '') {
  if (leftStrand.length === rightStrand.length) {
    if (leftStrand !== rightStrand) return leftStrand.split('').filter((ch, idx) => ch !== rightStrand[idx]).length;
    return 0;
  } throw new Error('left and right strands must be of equal length');
}
