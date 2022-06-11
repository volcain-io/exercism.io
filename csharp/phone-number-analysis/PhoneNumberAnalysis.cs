using System;

public static class PhoneNumber
{
    public static (bool IsNewYork, bool IsFake, string LocalNumber) Analyze(string phoneNumber)
    {
        bool IsNewYork = phoneNumber.StartsWith("212");
        bool IsFake = phoneNumber.Substring(phoneNumber.IndexOf("-") + 1, 3) == "555";
        string LocalNumber = phoneNumber.Substring(phoneNumber.LastIndexOf("-") + 1);

        return (IsNewYork, IsFake, LocalNumber);
    }

    public static bool IsFake((bool IsNewYork, bool IsFake, string LocalNumber) phoneNumberInfo)
    {
        return phoneNumberInfo.IsFake;
    }
}
