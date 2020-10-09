package isogram

import (
	"strings"
	"unicode"
)

// IsIsogram checks if the given strings is an isogram.
func IsIsogram(word string) bool {
	lowercase := strings.ToLower(word)
	letterMap := make(map[rune]bool)
	for _, runeValue := range lowercase {
		if unicode.IsLetter(runeValue) {
			if letterMap[runeValue] {
				return false
			}
			letterMap[runeValue] = true
		}
	}

	return true
}
