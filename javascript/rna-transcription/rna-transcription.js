export function toRna(dnaStrand) {
  const rnaToDna = {
    A: 'U',
    C: 'G',
    G: 'C',
    T: 'A',
  };

  if (dnaStrand.match(/[^ACGT]/g)) throw new Error('Invalid input DNA.');

  return dnaStrand.replace(/[ACGT]/g, match => rnaToDna[match]);
}
