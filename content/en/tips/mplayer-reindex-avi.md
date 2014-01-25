/*
Title: How to rebuild the index of an AVI file
Description: 
Author: Sébastien Lucas
Date: 2011/02/07
Robots: noindex,nofollow
Language: en
Tags: multimedia,tips
*/
# How to rebuild the index of an AVI file

```
mencoder BadSource.avi -noskip -mc 0 -idx ovc copy -oac copy -o GoodOutput.avi
```





