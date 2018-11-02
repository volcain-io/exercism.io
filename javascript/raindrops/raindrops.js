class Raindrops {
  convert(number = 1) {
    let result = '';

    // we are just interested in 3, 5, 7
    if (number % 3 === 0) result += 'Pling';
    if (number % 5 === 0) result += 'Plang';
    if (number % 7 === 0) result += 'Plong';

    if (result.length === 0) result = `${number}`;

    return result;
  }
}

export default Raindrops;
