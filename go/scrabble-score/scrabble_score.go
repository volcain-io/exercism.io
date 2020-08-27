// Package scrabble provides a simple implementation to
// compute the Scrabble score for a word
package scrabble

import (
	"strings"
)

// Compute the Scrabble score of the given word
func Score(word string) int {
	scoreTable := map[string]int{
		"A": 1,
		"B": 3,
		"C": 3,
		"D": 2,
		"E": 1,
		"F": 4,
		"G": 2,
		"H": 4,
		"I": 1,
		"J": 8,
		"K": 5,
		"L": 1,
		"M": 3,
		"N": 1,
		"O": 1,
		"P": 3,
		"Q": 10,
		"R": 1,
		"S": 1,
		"T": 1,
		"U": 1,
		"V": 4,
		"W": 4,
		"X": 8,
		"Y": 4,
		"Z": 10,
	}

	sum := 0
	for letter, score := range scoreTable {
		sum += strings.Count(strings.ToUpper(word), letter) * score
	}

	return sum
}
