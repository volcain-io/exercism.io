using System;
using System.Collections.Generic;

static class SavingsAccount
{
    private static readonly float INTEREST_RATE_FOR_NEGATIVE_BALANCE = 3.213f;
    private static readonly float INTEREST_RATE_FOR_BALANCE_MIN_0_LESS_1000 = 0.5f;
    private static readonly float INTEREST_RATE_FOR_BALANCE_MIN_1000_LESS_5000 = 1.621f;
    private static readonly float INTEREST_RATE_FOR_BALANCE_MIN_5000 = 2.475f;
    public static float InterestRate(decimal balance)
    {
        return balance switch
        {
            _ when balance < 0m => INTEREST_RATE_FOR_NEGATIVE_BALANCE,
            _ when balance >= 0m && balance < 1000m => INTEREST_RATE_FOR_BALANCE_MIN_0_LESS_1000,
            _ when balance >= 1000m && balance < 5000m => INTEREST_RATE_FOR_BALANCE_MIN_1000_LESS_5000,
            _ => INTEREST_RATE_FOR_BALANCE_MIN_5000,
        };
    }

    public static decimal Interest(decimal balance)
    {
        Decimal interestRate = new Decimal(SavingsAccount.InterestRate(balance));
        Decimal calculatedBalance = Decimal.Multiply(interestRate, balance);

        return Decimal.Divide(calculatedBalance, 100m);
    }

    public static decimal AnnualBalanceUpdate(decimal balance)
    {
        return Decimal.Add(balance, SavingsAccount.Interest(balance));
    }

    public static int YearsBeforeDesiredBalance(decimal balance, decimal targetBalance)
    {
        if (targetBalance < balance)
            return 0;

        return YearsBeforeDesiredBalance(SavingsAccount.AnnualBalanceUpdate(balance), targetBalance) + 1;
    }
}
