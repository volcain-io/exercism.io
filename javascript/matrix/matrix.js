export class Matrix {
  rows = [];
  columns = [];

  constructor(matrix) {
    this.rows = this._to_array(matrix);
    this.columns = this._transpose(this.rows);
  }

  get rows() {
    return this.rows;
  }

  get columns() {
    return this.columns;
  }

  _to_array(matrix) {
    return matrix
      .split("\n")
      .map((row) => row.split(" ").map((value) => parseInt(value)));
  }

  _transpose(arr) {
    return Object.keys(arr[0]).map((curr) => arr.map((row) => row[curr]));
  }
}
