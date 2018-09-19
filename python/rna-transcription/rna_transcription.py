def to_rna(dna_strand):
    # map DNA to RNA
    trans = str.maketrans("ACGT", "UGCA")

    # replace complements
    return dna_strand.translate(trans)
