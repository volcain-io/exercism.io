// imperative solution
export function compute(leftStrand = '', rightStrand = '') {
  if (leftStrand.length === rightStrand.length) {
    let diffCount = 0;
    if (leftStrand !== rightStrand) {
      const splitted = leftStrand.split('');
      for(let idx = 0; idx < splitted.length; idx++) {
        const ch = splitted[idx];
        if ( ch !== rightStrand[idx] )
          diffCount++;
      }
    }
    return diffCount;
  } throw new Error('left and right strands must be of equal length');
}

// declarative solution
export function computeDeclarative(leftStrand = '', rightStrand = '') {
  if (leftStrand.length === rightStrand.length) {
    if (leftStrand !== rightStrand)
      return leftStrand.split('').filter((ch, idx) => ch !== rightStrand[idx]).length;
    return 0;
  } throw new Error('left and right strands must be of equal length');
}
