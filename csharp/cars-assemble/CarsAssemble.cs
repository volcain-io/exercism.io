using System;
using System.ComponentModel;

static class AssemblyLine
{
    private const int TOTAL_CARS_PRODUCED_PER_HOUR = 221;
    private const int MINUTES_PER_HOUR = 60;
    public static double SuccessRate(int speed)
    {
        if (speed == 0)
            return 0.00;
        else if (speed < 5)
            return 1.00;
        else if (speed < 9)
            return 0.90;
        else if (speed == 9)
            return 0.80;
        else
            return 0.77;
    }

    public static double ProductionRatePerHour(int speed)
    {
        return speed * TOTAL_CARS_PRODUCED_PER_HOUR * SuccessRate(speed);
    }

    public static int WorkingItemsPerMinute(int speed)
    {
        return (int)ProductionRatePerHour(speed) / MINUTES_PER_HOUR;
    }
}
