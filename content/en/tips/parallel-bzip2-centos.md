/*
Title: How to install a SMP aware bzip2 with Centos
Description: 
Author: Sébastien Lucas
Date: 2011/06/10
Robots: noindex,nofollow
Language: en
Tags: centos,tips
*/
# How to install a SMP aware bzip2 with Centos

## Two alternatives

*	[PBZIP2](http://www.compression.ca/pbzip2/)
*	[lbzip2](http://www.linuxinsight.com/lbzip2-parallel-bzip2-utility.html)

## My choice

*	Get the rpm :

```
wget http://img.cs.montana.edu/linux/centos/5.6/dag/x86_64/lbzip2-0.23-1.el5.rf.x86_64.rpm
```

*	Install it :

```
rpm -ivh lbzip2-0.23-1.el5.rf.x86_64.rpm
```

*	Enjoy (the usage is the same as bzip2)






