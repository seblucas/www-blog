---
title: "How to create an iso with a dvd structure"
date: 2011-02-07
tags: [multimedia,tips]
slug: mkisofs-create-dvd-iso
aliases: [/en/tips/mkisofs-create-dvd-iso]
---
# How to create an iso with a dvd structure

You'll have to install mkisofs :

```
aptitude install mkisofs
```

and then use it :

```
mkisofs -dvd-video -udf -o file.iso file
```





