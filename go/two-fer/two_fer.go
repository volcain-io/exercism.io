// Package twofer provides a simple implementation of the
// common form of "two for one"
package twofer

// ShareWith puts together a sentence with x as placeholder.
// If no argument is given, x defaults to "you".
// Returns following string "One for x, one for me."
func ShareWith(name string) string {
	if name == "" {
		name = "you"
	}

	return "One for " + name + ", one for me."
}
