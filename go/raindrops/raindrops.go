// Package raindrops provides a simple implementation of the
// famous 'FizzBuzz' problem
package raindrops

import "strconv"

// Convert converts a given number into a string containing raindrops
// sounds corresponding to ceratin potential factors
// Returns the raindrops string
func Convert(number int) string {
	result := ""

	if number%3 == 0 {
		result = "Pling"
	}
	if number%5 == 0 {
		result += "Plang"
	}
	if number%7 == 0 {
		result += "Plong"
	}

	if len(result) == 0 {
		result = strconv.Itoa(number)
	}

	return result
}
