using System;

class RemoteControlCar
{
    private int TotalDistanceDrivenInMeters = 0;
    private int TotalBatteryPercentage = 100;
    private static readonly int DISTANCE_PER_DRIVE_IN_METERS = 20;
    private static readonly int BATTERY_DRAIN_PER_DRIVE_IN_PERCENTAGE = 1;
    public static RemoteControlCar Buy()
    {
        return new RemoteControlCar();
    }

    public string DistanceDisplay()
    {
        return "Driven " + this.TotalDistanceDrivenInMeters + " meters";
    }

    public string BatteryDisplay()
    {
        string msg = "Battery empty";
        if (this.TotalBatteryPercentage > 0)
            msg = "Battery at " + this.TotalBatteryPercentage + "%";

        return msg;
    }

    public void Drive()
    {
        if (this.TotalBatteryPercentage > 0)
        {
            this.TotalBatteryPercentage -= BATTERY_DRAIN_PER_DRIVE_IN_PERCENTAGE;
            this.TotalDistanceDrivenInMeters += DISTANCE_PER_DRIVE_IN_METERS;
        }
    }
}
