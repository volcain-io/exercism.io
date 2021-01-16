// imperative solution
function compute(leftStrand = '', rightStrand = '') {
  if (leftStrand.length !== rightStrand.length) {
    throw new Error('left and right strands must be of equal length');
  }

  let diffCount = 0;
  if (leftStrand === rightStrand) return diffCount;

  for (let idx = 0; idx < leftStrand.length; idx += 1) {
    if (leftStrand.charAt(idx) !== rightStrand.charAt(idx)) {
      diffCount += 1;
    }
  }
  return diffCount;
}

// declarative solution
function computeDeclarative(leftStrand = '', rightStrand = '') {
  if (leftStrand.length === rightStrand.length) {
    if (leftStrand !== rightStrand) {
      return leftStrand.split('').filter((ch, idx) => ch !== rightStrand[idx])
        .length;
    }
    return 0;
  }
  throw new Error('left and right strands must be of equal length');
}

export { compute, computeDeclarative };
