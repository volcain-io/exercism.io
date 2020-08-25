// Package raindrops provides a simple implementation of the
// famous 'FizzBuzz' problem
package raindrops

import (
	"sort"
	"strconv"
)

// Convert converts a given number into a string containing raindrops
// sounds corresponding to ceratin potential factors
// Returns the raindrops string
func Convert(number int) string {
	result := ""
	factorSoundsMap := map[int]string{
		3: "Pling",
		5: "Plang",
		7: "Plong",
	}
	factors := make([]int, 0, len(factorSoundsMap))
	for factor := range factorSoundsMap {
		factors = append(factors, factor)
	}
	sort.Ints(factors)

	for _, factor := range factors {
		if number%factor == 0 {
			result += factorSoundsMap[factor]
		}
	}

	if len(result) == 0 {
		result = strconv.Itoa(number)
	}

	return result
}
