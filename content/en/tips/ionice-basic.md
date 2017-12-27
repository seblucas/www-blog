/*
Title: How to "nice" the I/O
Description: 
Author: Sébastien Lucas
Date: 2011/02/07
Robots: noindex,nofollow
Language: en
Tags: debian,tips
*/
# How to "nice" the I/O

*	ionice  : http://linux.die.net/man/1/ionice|ionice
*	Install

```
aptitude install util-linux
```

*	Extreme case : only run a program when I/O is idle (root mandatory) :

```
ionice -c3 xfs_fsr -t 600
```

*	An addition to my .bashrc to ensure my niced program also preserve my I/O

```
alias nice='ionice -c2 -n7 nice'
```

*	My source : http://gentoo-wiki.com/HOWTO_Light_Gentoo_Installation#Extra:_ionice





