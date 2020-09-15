import java.text.CharacterIterator;
import java.text.StringCharacterIterator;

public class Hamming {
  private String leftStrand;
  private String rightStrand;

  public Hamming(final String _leftStrand, final String _rightStrand) {
    this.validate(_leftStrand, _rightStrand);
    this.leftStrand = _leftStrand;
    this.rightStrand = _rightStrand;
  }

  public int getHammingDistance() {
    int count = 0;

    CharacterIterator it = new StringCharacterIterator(this.leftStrand);
    while (it.current() != CharacterIterator.DONE) {
      if (it.current() != this.rightStrand.charAt(it.getIndex()))
        count++;
      it.next();
    }

    return count;
  }

  private void validate(final String _leftStrand, final String _rightStrand) {
    String errorMessage = null;

    if (_leftStrand.length() != _rightStrand.length()) {
      errorMessage = "leftStrand and rightStrand must be of equal length.";

      if (_leftStrand.isEmpty())
        errorMessage = "left strand must not be empty.";
      if (_rightStrand.isEmpty())
        errorMessage = "right strand must not be empty.";
    }

    if (null != errorMessage)
      throw new IllegalArgumentException(errorMessage);
  }
}
