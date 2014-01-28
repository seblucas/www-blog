/*
Title: How to remove trailing whitespace from a bunch of files
Description: 
Author: Sébastien Lucas
Date: 2011/02/07
Robots: noindex,nofollow
Language: en
Tags: debian,tips
*/
# How to remove trailing whitespace from a bunch of files

## Linux files (and also Mac)

```
find . -name '*.js' -exec sed -i 's/[[:blank:]]*\n$/\n/g' '{}' \;
```

## Windows files

```
find . -name '*.js' -exec sed -i 's/[[:blank:]]*\r$/\r/g' '{}' \;
```

## Sed oneliners

http://sed.sourceforge.net/sed1line.txt





