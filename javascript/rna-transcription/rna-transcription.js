export function toRna(dnaStrand) {
  return dnaStrand
    .split('')
    .map((nucleotide) => {
      if (nucleotide === 'G') return 'C';
      if (nucleotide === 'C') return 'G';
      if (nucleotide === 'T') return 'A';
      if (nucleotide === 'A') return 'U';
      throw new Error('Invalid input DNA.');
    })
    .join('');
}
