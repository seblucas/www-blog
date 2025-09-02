---
title: "How to convert a file from ISO-8859-P1 to UTF-8"
date: 2011-02-07
tags: [debian,tips]
slug: iso-to-utf8
disqus_identifier: /en/tips/iso-to-utf8
aliases: [/en/tips/iso-to-utf8]
---
# How to convert a file from ISO-8859-P1 to UTF-8

```
iconv --from-code=ISO-8859-1 --to-code=UTF-8 ./oldfile.txt > ./newfile.txt
```





