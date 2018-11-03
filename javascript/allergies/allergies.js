class Allergies {
  constructor(score) {
    this.score = score;
    this.allergySet = [
      'eggs', // 1
      'peanuts', // 2
      'shellfish', // 4
      'strawberries', // 8
      'tomatoes', // 16
      'chocolate', // 32
      'pollen', // 64
      'cats', // 128
    ];
  }

  list() {
    return this.allergySet.filter((allergy) => {
      if (this.allergicTo(allergy)) return allergy;
    });
  }

  allergicTo(allergy) {
    return Boolean(this.score & (2 ** this.allergySet.indexOf(allergy)));
  }
}

export default Allergies;
