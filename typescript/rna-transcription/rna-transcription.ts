const complements: Readonly<Record<string, string>> = {
    G: "C",
    C: "G",
    T: "A",
    A: "U",
};
type DNANucleotide = Readonly<keyof typeof complements>;

class Transcriptor {
    toRna(dnaStrand: string): string {
        if (this.isInvalidDNA(dnaStrand)) {
            throw new Error('Invalid input DNA.');
        }

        return dnaStrand.split('')
            .map((ch) => complements[ch as DNANucleotide])
            .join('');
    }

    private isInvalidDNA(input: string = ""): boolean {
        return input.match(/[^GCTA]+/g) !== null;
    }
}

export default Transcriptor
