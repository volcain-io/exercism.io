public class Twofer {
  public String twofer(String _name) {
    if (null == _name)
      _name = "you";
    return "One for " + _name + ", one for me.";
  }
}
