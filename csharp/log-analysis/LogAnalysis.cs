using System;

public static class LogAnalysis
{
    public static string SubstringAfter(this string str, string delimeter)
    {
        int startIndex = str.IndexOf(delimeter) + delimeter.Length;
        return str.Substring(startIndex);
    }

    public static string SubstringBetween(this string str, string start, string end)
    {
        int startIndex = str.IndexOf(start) + start.Length;
        int length = str.IndexOf(end) - startIndex;
        return str.Substring(startIndex, length);
    }

    public static string Message(this string str)
    {
        return str.SubstringAfter(": ");
    }

    public static string LogLevel(this string str)
    {
        return str.SubstringBetween("[", "]");
    }
}