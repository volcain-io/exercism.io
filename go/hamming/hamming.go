// Package hamming provides a simple implementation of the
// differences between two DNA strands
package hamming

import (
	"errors"
	"unicode/utf8"
)

// Distance counts the differences between two DNA strands (Hamming Distance).
// Returns an error, if one of the DNA strands is of different length.
// Returns the number of differences.
func Distance(a, b string) (int, error) {
	if utf8.RuneCountInString(a) != utf8.RuneCountInString(b) {
		return 0, errors.New("left and right strands must be of equal length")
	}

	runeA := []rune(a)
	runeB := []rune(b)

	diffCounter := 0
	for i := 0; i < len(runeA); i++ {
		if runeA[i] != runeB[i] {
			diffCounter++
		}
	}

	return diffCounter, nil
}
