---
title: "How to defrag an XFS partition"
date: 2011-02-07
tags: [debian,tips]
slug: xfs-defrag
disqus_identifier: /en/tips/xfs-defrag
aliases: [/en/tips/xfs-defrag]
---
# How to defrag an XFS partition

*	Install

```
aptitude install xfsdump
```

*	Usage

```
xfs_fsr -t 600
```

It will try to defrag all you XFS partition for 600 seconds (10 minutes).





