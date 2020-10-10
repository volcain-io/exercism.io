const complements: Readonly<Record<string, string>> = {
    G: "C",
    C: "G",
    T: "A",
    A: "U",
};
const DNANucleotideList = (Object.keys(complements)).reduce((acc, curr) => "" + acc + curr);
const re = new RegExp("[^" + DNANucleotideList + "]");

class Transcriptor {
    toRna(dnaStrand: string): string {
        this.checkForInvalidDNA(dnaStrand);

        return dnaStrand.split('')
            .map((ch) => complements[ch])
            .join('');
    }

    private raiseError(): Error {
        throw new Error('Invalid input DNA.');
    }

    private checkForInvalidDNA(input: string): void {
        input.match(re) !== null && this.raiseError();
    }
}

export default Transcriptor
