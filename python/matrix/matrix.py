"""Matrix exercise from exercism.io python path.

Given a string representing a matrix of numbers,
return the rows and columns of that matrix.
"""


class Matrix:
    """Matrix class

    Given a string representing a matrix of numbers,
    return the rows and columns of that matrix.
    """
    def __init__(self, matrix_string):
        self.matrix_array = self._to_array(matrix_string)

    def row(self, index):
        """Get row values by its index.

        Args:
            index: positive integer.

        Returns:
            An array of integers representing the row values.
        """
        return self.matrix_array[index - 1]

    def column(self, index):
        """Get column values by its index.

        Args:
            index: positive integer.

        Returns:
            An array of integers representing the column values.
        """
        columns = []
        for row in self.matrix_array:
            columns.append(row[index - 1])
        return columns

    @classmethod
    def _to_array(cls, matrix_string):
        """Get multi-dimensional array

        Args:
            string: string representing the matrix, e.g. "1 2 3\n4 5 6\n7 8 9"

        Returns:
            A multi-dimensional array representing the matrix.
        """
        matrix_array = []
        plain_rows = matrix_string.split('\n')
        for row in plain_rows:
            rows = []
            values = row.split(' ')
            for value in values:
                rows.append(int(value))
            matrix_array.append(rows)
        return matrix_array
