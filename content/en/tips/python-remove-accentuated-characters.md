/*
Title: How to remove accentuated characters from a string with Python
Description: 
Author: Sébastien Lucas
Date: 2011/08/31
Robots: noindex,nofollow
Language: en
Tags: python,tips
*/
# How to remove accentuated characters from a string with Python

Easy :

```python
output = unicodedata.normalize('NFKD', input).encode('ASCII', 'ignore')
```

If your input string is not unicode, you'll have to convert it first :

```python
output = unicodedata.normalize('NFKD', unicode (input, 'utf-8')).encode('ASCII', 'ignore')
```







