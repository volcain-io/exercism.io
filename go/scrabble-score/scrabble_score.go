// Package scrabble provides a simple implementation to
// compute the Scrabble score for a word
package scrabble

import (
	"unicode"
)

var scoreTable = map[rune]int{
	'A': 1,
	'B': 3,
	'C': 3,
	'D': 2,
	'E': 1,
	'F': 4,
	'G': 2,
	'H': 4,
	'I': 1,
	'J': 8,
	'K': 5,
	'L': 1,
	'M': 3,
	'N': 1,
	'O': 1,
	'P': 3,
	'Q': 10,
	'R': 1,
	'S': 1,
	'T': 1,
	'U': 1,
	'V': 4,
	'W': 4,
	'X': 8,
	'Y': 4,
	'Z': 10,
}

// Compute the Scrabble score of the given word
func Score(word string) int {
	runeWord := []rune(word)
	if len(runeWord) == 0 {
		return 0
	}
	return Score(word[1:]) + scoreTable[unicode.ToUpper(runeWord[0])]
}
