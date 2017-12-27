---
title: "How to extract a specific file from an archive"
date: 2012-03-27
tags: [debian,windows]
slug: extract-specific-file-from-archive
disqus_identifier: /en/tips/extract-specific-file-from-archive
aliases: [/en/tips/extract-specific-file-from-archive]
---
# How to extract a specific file from an archive

I'll use 7zip :

```
7z e *.rar -ir!*.txt
```

Here I'll extract all txt files from every rar archive in my directory.

Check if your binary is 7z or 7za


