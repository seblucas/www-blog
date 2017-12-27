/*
Title: How to extract a specific file from an archive
Description: 
Author: Sébastien Lucas
Date: 2012/03/27
Robots: noindex,nofollow
Language: en
Tags: debian,windows
*/
# How to extract a specific file from an archive

I'll use 7zip :

```
7z e *.rar -ir!*.txt
```

Here I'll extract all txt files from every rar archive in my directory.

Check if your binary is 7z or 7za


