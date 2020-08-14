package hamming

import "errors"

func Distance(a, b string) (int, error) {
	result := 0

	if len(a) == len(b) {
		if a != b {
			for i := 0; i < len(a); i++ {
				if a[i] != b[i] {
					result += 1
				}
			}
		}
		return result, nil
	}

	return result, errors.New("left and right strands must be of equal length")
}
