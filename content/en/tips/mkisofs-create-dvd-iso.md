/*
Title: How to create an iso with a dvd structure
Description: 
Author: Sébastien Lucas
Date: 2011/02/07
Robots: noindex,nofollow
Language: en
Tags: multimedia,tips
*/
# How to create an iso with a dvd structure

You'll have to install mkisofs :

```
aptitude install mkisofs
```

and then use it :

```
mkisofs -dvd-video -udf -o file.iso file
```





