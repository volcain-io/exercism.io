using System;

static class LogLine
{
    public static string Message(string logLine)
    {
        int startIndex = logLine.IndexOf(':') + 1;
        return logLine.Substring(startIndex).Trim();
    }

    public static string LogLevel(string logLine)
    {
        int startIndex = logLine.IndexOf('[') + 1;
        int length = logLine.IndexOf(']') - 1;
        return logLine.Substring(startIndex, length).ToLower();
    }

    public static string Reformat(string logLine)
    {
        return LogLine.Message(logLine) + " (" + LogLine.LogLevel(logLine) + ")";
    }
}
