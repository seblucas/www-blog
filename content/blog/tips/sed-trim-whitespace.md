---
title: "How to remove trailing whitespace from a bunch of files"
date: 2011-02-07
tags: [debian,tips]
slug: sed-trim-whitespace
disqus_identifier: /en/tips/sed-trim-whitespace
aliases: [/en/tips/sed-trim-whitespace]
---
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





