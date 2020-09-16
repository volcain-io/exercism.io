import java.text.CharacterIterator;
import java.text.StringCharacterIterator;

public class Hamming {
  private int hammingDistance = 0;

  public Hamming(final String leftStrand, final String rightStrand) {
    this.validate(leftStrand, rightStrand);
    this.calculate(leftStrand, rightStrand);
  }

  public int getHammingDistance() {
    return this.hammingDistance;
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

  private void calculate(final String _leftStrand, final String _rightStrand) {
    CharacterIterator it = new StringCharacterIterator(_leftStrand);
    while (it.current() != CharacterIterator.DONE) {
      if (it.current() != _rightStrand.charAt(it.getIndex()))
        this.hammingDistance++;
      it.next();
    }
  }
}
