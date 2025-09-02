---
title: "How to use matching group in sed replacement"
date: 2018-02-03
tags: [debian,tips]
slug: sed-matching-group
disqus_identifier: /blog/sed-matching-group
---

## With one capture group

```
sed -i 's/^Title\: \(.*\)$/title: "\1"/g' *.md
```

## With more capture groups

```
sed -i 's|^Date: \([[:digit:]]\{4\}\)/\([[:digit:]]\{2\}\)/|date: \1-\2-|g' *.md
```


