const COMPLEMENTS = {
  G: 'C',
  C: 'G',
  T: 'A',
  A: 'U',
};

export function toRna(dnaStrand) {
  if (dnaStrand.match(/[^GCTA]+/g) !== null) {
    throw new Error('Invalid input DNA.');
  }
  return dnaStrand
    .split('')
    .map(nucleotide => COMPLEMENTS[nucleotide])
    .join('');
}
