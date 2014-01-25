/*
Title: How to count the number of files in a directory
Description: 
Author: Sébastien Lucas
Date: 2011/02/08
Robots: noindex,nofollow
Language: en
Tags: debian,tips
*/
# How to count the number of files in a directory

## Non recursive
```
find targetdir -type f -maxdepth 1 | wc -l 
```
## Recursive

```
find targetdir -type f | wc -l 
```
## Recursive and follow symlink

```
find targetdir -type f -follow | wc -l 
```






