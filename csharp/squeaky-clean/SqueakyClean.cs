using System;
using System.Text;

public static class Identifier
{
    public static string Clean(string identifier)
    {
        if (String.Empty == identifier)
            return String.Empty;

        StringBuilder sbString = new StringBuilder();
        bool nextLetterToUpper = false;

        foreach (char c in identifier)
        {
            if ('α' <= c && 'ω' >= c)
                continue;
            if (Char.IsWhiteSpace(c))
                sbString.Append('_');
            if (Char.IsControl(c))
                sbString.Append("CTRL");
            if (nextLetterToUpper)
            {
                sbString.Append(c.ToString().ToUpperInvariant());
                nextLetterToUpper = false;
                continue;
            }
            if ('-' == c)
            {
                nextLetterToUpper = true;
                continue;
            }
            if (Char.IsLetter(c))
                sbString.Append(c);
        }

        return sbString.ToString();
    }
}
