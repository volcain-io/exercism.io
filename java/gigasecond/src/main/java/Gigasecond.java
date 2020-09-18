import java.time.LocalDate;
import java.time.LocalDateTime;
import java.time.temporal.ChronoUnit;

public class Gigasecond {
  private LocalDateTime dateTime;
  private static final long GIGASECOND_IN_MS = (long) Math.pow(10, 12);

    public Gigasecond(final LocalDate moment) {
      this(moment.atTime(0, 0, 0, 0));
    }

    public Gigasecond(final LocalDateTime moment) {
      this.dateTime = moment.plus(GIGASECOND_IN_MS, ChronoUnit.MILLIS);
    }

    public LocalDateTime getDateTime() {
      return this.dateTime;
    }
}
