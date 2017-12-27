---
title: "How to join two AVI files"
date: 2011-02-07
tags: [multimedia,tips]
slug: mplayer-merge-avi
aliases: [/en/tips/mplayer-merge-avi]
---
# How to join two AVI files

```
mencoder -oac copy -ovc copy -noodml -idx part1.avi part2.avi -o complete.avi
```





