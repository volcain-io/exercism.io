using System;
using System.Linq;
using Xunit.Sdk;

class BirdCount
{
    private int[] birdsPerDay;

    public BirdCount(int[] birdsPerDay)
    {
        this.birdsPerDay = birdsPerDay;
    }

    public static int[] LastWeek()
    {
        return new int[] { 0, 2, 5, 3, 7, 8, 4 };
    }

    public int Today()
    {
        int idxToday = this.birdsPerDay.Length - 1;
        return this.birdsPerDay[idxToday];
    }

    public void IncrementTodaysCount()
    {
        int idxToday = this.birdsPerDay.Length - 1;
        this.birdsPerDay.SetValue(this.Today() + 1, idxToday);
    }

    public bool HasDayWithoutBirds()
    {
        return this.birdsPerDay.Contains(0);
    }

    public int CountForFirstDays(int numberOfDays)
    {
        int totalCount = 0;

        if (numberOfDays < 0 || numberOfDays > this.birdsPerDay.Length)
            return totalCount;

        for (int idx = 0; idx < numberOfDays; idx++)
        {
            totalCount += this.birdsPerDay[idx];
        }

        return totalCount;
    }

    public int BusyDays()
    {
        int totalBusyDays = 0;

        foreach (int dayCount in this.birdsPerDay)
        {
            totalBusyDays += dayCount >= 5 ? 1 : 0;
        }

        return totalBusyDays;
    }
}
