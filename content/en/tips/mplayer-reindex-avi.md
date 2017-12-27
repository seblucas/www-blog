---
title: "How to rebuild the index of an AVI file"
date: 2011-02-07
tags: [multimedia,tips]
slug: mplayer-reindex-avi
aliases: [/en/tips/mplayer-reindex-avi]
---
# How to rebuild the index of an AVI file

```
mencoder BadSource.avi -noskip -mc 0 -idx ovc copy -oac copy -o GoodOutput.avi
```





