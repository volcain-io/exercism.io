class Triangle {
  constructor(sideA, sideB, sideC) {
    this.sideA = sideA;
    this.sideB = sideB;
    this.sideC = sideC;
  }

  triangleEquality() {
    return 2 * Math.max(this.sideA, this.sideB, this.sideC) < this.sideA + this.sideB + this.sideC;
  }

  kind() {
    if (this.triangleEquality()) {
      const sideSet = new Set();

      sideSet.add(this.sideA);
      sideSet.add(this.sideB);
      sideSet.add(this.sideC);

      switch (sideSet.size) {
        case 1:
          return "equilateral";
        case 2:
          return "isosceles";
        default:
          return "scalene";
      }
    } else {
      throw new Error("Illegal triangle values");
    }
  }
}

export default Triangle;
