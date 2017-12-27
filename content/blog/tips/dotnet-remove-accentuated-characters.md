---
title: "How to remove accentuated characters from a string with C#"
date: 2011-08-31
tags: [dotnet,tips]
slug: dotnet-remove-accentuated-characters
disqus_identifier: /en/tips/dotnet-remove-accentuated-characters
aliases: [/en/tips/dotnet-remove-accentuated-characters]
---
# How to remove accentuated characters from a string with C#

```csharp
public string RemoveAccentuatedCharacters(string input)
{
	byte[] aOctets = System.Text.Encoding.GetEncoding(1251).GetBytes(input);
	return System.Text.Encoding.ASCII.GetString(aOctets);
}
```

