import java.text.CharacterIterator;
import java.text.StringCharacterIterator;

public class Hamming {
  private int hammingDistance = 0;

  public Hamming(final String leftStrand, final String rightStrand) {
    this.validate(leftStrand, rightStrand);

    CharacterIterator it = new StringCharacterIterator(leftStrand);
    while (it.current() != CharacterIterator.DONE) {
      if (it.current() != rightStrand.charAt(it.getIndex()))
        this.hammingDistance++;
      it.next();
    }
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
}
