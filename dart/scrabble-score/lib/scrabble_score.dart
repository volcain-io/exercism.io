int score([final String word = '']) {
  int sum = 0;
  for ( int i=0; i < word.length; i ++) {
    switch(word[i].toLowerCase()) {
      case 'a':
      case 'e':
      case 'i':
      case 'l':
      case 'n':
      case 'o':
      case 'r':
      case 's':
      case 't':
      case 'u':
        sum += 1;
        break;
      case 'd':
      case 'g':
        sum += 2;
        break;
      case 'b':
      case 'c':
      case 'm':
      case 'p':
        sum += 3;
        break;
      case 'f':
      case 'h':
      case 'v':
      case 'w':
      case 'y':
        sum += 4;
        break;
      case 'k':
        sum += 5;
        break;
      case 'j':
      case 'x':
        sum += 8;
        break;
      case 'q':
      case 'z':
        sum += 10;
        break;
      default:
        sum += 0;
    }
  }
  return sum;
}
