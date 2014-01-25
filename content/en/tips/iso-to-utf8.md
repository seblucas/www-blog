/*
Title: How to convert a file from ISO-8859-P1 to UTF-8
Description: 
Author: Sébastien Lucas
Date: 2011/02/07
Robots: noindex,nofollow
Language: en
Tags: debian,tips
*/
# How to convert a file from ISO-8859-P1 to UTF-8

```
iconv --from-code=ISO-8859-1 --to-code=UTF-8 ./oldfile.txt > ./newfile.txt
```





