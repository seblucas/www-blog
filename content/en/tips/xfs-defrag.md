/*
Title: How to defrag an XFS partition
Description: 
Author: Sébastien Lucas
Date: 2011/02/07
Robots: noindex,nofollow
Language: en
Tags: debian,tips
*/
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





