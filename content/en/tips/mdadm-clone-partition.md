/*
Title: How to clone all the partitions of a disk
Description: 
Author: Sébastien Lucas
Date: 2011/02/07
Robots: noindex,nofollow
Language: en
Tags: debian,tips
*/
# How to clone all the partitions of a disk

If you want to create the same partitions as an existing disk and if those disks are exactly the same, then you can use the following command :
```
sfdisk -d /dev/hda | sfdisk /dev/hdb
```


