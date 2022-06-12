using System;
using System.Runtime.Serialization;

static class Appointment
{
    private static readonly DateTime SALON_OPENING_DATE_TIME = new DateTime(2012, 9, 15, 0, 0, 0);
    public static DateTime Schedule(string appointmentDateDescription)
    {
        return DateTime.Parse(appointmentDateDescription);
    }

    public static bool HasPassed(DateTime appointmentDate)
    {
        return appointmentDate < DateTime.Now;
    }

    public static bool IsAfternoonAppointment(DateTime appointmentDate)
    {
        return 12 <= appointmentDate.Hour && 18 > appointmentDate.Hour;
    }

    public static string Description(DateTime appointmentDate)
    {
        // G Format Specifier - en-US Culture - e.g. 10/31/2008 5:04:32 PM
        return String.Format("You have an appointment on {0}.", appointmentDate.ToString("G"));
    }

    public static DateTime AnniversaryDate()
    {
        return SALON_OPENING_DATE_TIME.AddYears(10);
    }
}
