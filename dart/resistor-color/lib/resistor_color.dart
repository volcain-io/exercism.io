class ResistorColor {
  final List<String> _colors = [ "black", "brown", "red", "orange", "yellow", "green", "blue", "violet", "grey", "white" ];

  List<String> get colors {
    return _colors;
  }

  int colorCode([final String name = ""]) {
    return colors.indexOf(name.trim().toLowerCase());
  }
}
