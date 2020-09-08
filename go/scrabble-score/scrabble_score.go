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
		case 'A', 'E', 'I', 'L', 'N', 'O', 'R', 'S', 'T', 'U':
			sum += 1
		case 'D', 'G':
			sum += 2
		case 'B', 'C', 'M', 'P':
			sum += 3
		case 'F', 'H', 'V', 'W', 'Y':
			sum += 4
		case 'K':
			sum += 5
		case 'J', 'X':
			sum += 8
		case 'Q', 'Z':
			sum += 10
		default:
			sum += 0
		}
	}
	return sum
}
