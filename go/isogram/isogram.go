package isogram

import (
	"strings"
)

func IsIsogram(word string) bool {
	lowercase := strings.ToLower(word)

	for _, runeValue := range word {
		asciiValue := int(runeValue)
		if asciiValue >= 96 && asciiValue <= 122 {
			count := strings.Count(lowercase, string(runeValue))
			if count > 1 {
				return false
			}
		}
	}

	return true
}
