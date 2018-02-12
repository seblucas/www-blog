---
title: "How to count the number of files in a directory"
date: 2011-02-08
tags: [debian,tips]
slug: linux-count-number-files
disqus_identifier: /en/tips/linux-count-number-files
aliases: [/en/tips/linux-count-number-files]
---
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






