---
title: "How to remove accentuated characters from a string with Python"
date: 2011-08-31
tags: [python,tips]
slug: python-remove-accentuated-characters
disqus_identifier: /en/tips/python-remove-accentuated-characters
aliases: [/en/tips/python-remove-accentuated-characters]
---
# How to remove accentuated characters from a string with Python

Easy :

```python
output = unicodedata.normalize('NFKD', input).encode('ASCII', 'ignore')
```

If your input string is not unicode, you'll have to convert it first :

```python
output = unicodedata.normalize('NFKD', unicode (input, 'utf-8')).encode('ASCII', 'ignore')
```







