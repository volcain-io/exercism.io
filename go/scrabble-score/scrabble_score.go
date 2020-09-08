// Package scrabble provides a simple implementation to
// compute the Scrabble score for a word
package scrabble

import (
	"unicode"
)

// Compute the Scrabble score of the given word
func Score(word string) int {
	var sum int = 0
	for _, letter := range word {
		switch unicode.ToUpper(letter) {
		case 'A':
			sum += 1
		case 'B':
			sum += 3
		case 'C':
			sum += 3
		case 'D':
			sum += 2
		case 'E':
			sum += 1
		case 'F':
			sum += 4
		case 'G':
			sum += 2
		case 'H':
			sum += 4
		case 'I':
			sum += 1
		case 'J':
			sum += 8
		case 'K':
			sum += 5
		case 'L':
			sum += 1
		case 'M':
			sum += 3
		case 'N':
			sum += 1
		case 'O':
			sum += 1
		case 'P':
			sum += 3
		case 'Q':
			sum += 10
		case 'R':
			sum += 1
		case 'S':
			sum += 1
		case 'T':
			sum += 1
		case 'U':
			sum += 1
		case 'V':
			sum += 4
		case 'W':
			sum += 4
		case 'X':
			sum += 8
		case 'Y':
			sum += 4
		case 'Z':
			sum += 10
		default:
			sum += 0
		}
	}
	return sum
}
