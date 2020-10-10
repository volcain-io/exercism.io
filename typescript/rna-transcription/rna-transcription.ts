const complements: Readonly<Record<string, string>> = {
    G: "C",
    C: "G",
    T: "A",
    A: "U",
};

class Transcriptor {
    toRna(dnaStrand: string): string {
        return dnaStrand.split('')
            .map((ch) => complements[ch] || this.raiseError())
            .join('');
    }

    private raiseError(): Error {
        throw new Error('Invalid input DNA.');
    }
}

export default Transcriptor
