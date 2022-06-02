class Lasagna
{
    const int EXPECTED_BAKE_TIME_IN_MINUTES = 40;
    const int PREPARATION_TIME_PER_LAYER_IN_MINUTES = 2;

    public int ExpectedMinutesInOven()
    {
        return EXPECTED_BAKE_TIME_IN_MINUTES;
    }

    public int RemainingMinutesInOven(int elapsedMinutesInOven)
    {
        if (elapsedMinutesInOven < 0 || elapsedMinutesInOven > int.MaxValue)
        {
            return 0;
        }

        if (elapsedMinutesInOven > this.ExpectedMinutesInOven())
        {
            return 0;
        }
        
        return this.ExpectedMinutesInOven() - elapsedMinutesInOven;
    }

    public int PreparationTimeInMinutes(int numberOfLayers)
    {
        if (numberOfLayers < 0 || numberOfLayers > int.MaxValue)
        {
            return 0;
        }

        return numberOfLayers * PREPARATION_TIME_PER_LAYER_IN_MINUTES;
    }

    public int ElapsedTimeInMinutes(int numberOfLayers, int elapsedMinutesInOven)
    {
        return this.ExpectedMinutesInOven() - this.RemainingMinutesInOven(elapsedMinutesInOven) + this.PreparationTimeInMinutes(numberOfLayers);
    }
}
