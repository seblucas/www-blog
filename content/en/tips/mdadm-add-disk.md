/*
Title: How to add a new disk to an existing array
Description: 
Author: Sébastien Lucas
Date: 2011/02/07
Robots: noindex,nofollow
Language: en
Tags: debian,tips
*/
# How to add a new disk to an existing array

After a crash of one disk of my RAID 1 array I had to replace it :

```
mdadm --add /dev/md0 /dev/hdb4
mdadm --grow /dev/md0 --raid-devices=1
```


