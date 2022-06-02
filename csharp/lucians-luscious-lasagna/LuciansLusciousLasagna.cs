class Lasagna
{
    private const int EXPECTED_BAKE_TIME_IN_MINUTES = 40;
    private const int PREPARATION_TIME_PER_LAYER_IN_MINUTES = 2;

    public int ExpectedMinutesInOven() => EXPECTED_BAKE_TIME_IN_MINUTES;

    public int RemainingMinutesInOven(int elapsedMinutesInOven)
    {
        return this.ExpectedMinutesInOven() - elapsedMinutesInOven;
    }

    public int PreparationTimeInMinutes(int numberOfLayers)
    {
        return numberOfLayers * PREPARATION_TIME_PER_LAYER_IN_MINUTES;
    }

    public int ElapsedTimeInMinutes(int numberOfLayers, int elapsedMinutesInOven)
    {
        return this.PreparationTimeInMinutes(numberOfLayers) + elapsedMinutesInOven;
    }
}
