"""Calculate the Hamming Distance between two DNA Strands.

Given two strings each representing a DNA strand,
return the Hamming Distance between them.
"""


def distance(strand_a, strand_b):
    """Calculates the Hamming distance between two strands.

    Args:
        strand_a: A string representing a DNA strand.
        strand_b: A string representing a DNA strand.

    Returns:
        An integer representing the Hamming Distance between the two strands.
    """
    if len(strand_a) != len(strand_b):
        raise ValueError("left and right strands must be of equal length")

    hamming_distance = 0
    for idx, elem in enumerate(strand_a):
        if elem != strand_b[idx]:
            hamming_distance += 1

    return hamming_distance
