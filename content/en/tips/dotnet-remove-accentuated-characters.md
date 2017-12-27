/*
Title: How to remove accentuated characters from a string with C#
Description: 
Author: Sébastien Lucas
Date: 2011/08/31
Robots: noindex,nofollow
Language: en
Tags: dotnet,tips
*/
# How to remove accentuated characters from a string with C#

```csharp
public string RemoveAccentuatedCharacters(string input)
{
	byte[] aOctets = System.Text.Encoding.GetEncoding(1251).GetBytes(input);
	return System.Text.Encoding.ASCII.GetString(aOctets);
}
```

