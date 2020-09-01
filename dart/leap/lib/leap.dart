class Leap {
  bool leapYear(final int year) =>
      year % 4 == 0 && (year % 100 != 0 || year % 400 == 0);
}
