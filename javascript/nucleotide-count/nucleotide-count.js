function count(strand, source) {
  const regex = new RegExp(source, 'g');
  return (strand.match(regex) || '').length;
}

class NucleotideCounts {
  static parse(strand) {
    if (count(strand, '[^ACGT]')) throw new Error('Invalid nucleotide in strand');
    return `${count(strand, 'A')} ${count(strand, 'C')} ${count(strand, 'G')} ${count(strand, 'T')}`;
  }
}

export default NucleotideCounts;
