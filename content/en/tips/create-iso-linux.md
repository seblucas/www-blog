/*
Title: How to create an iso of a CD / DVD
Description: 
Author: Sébastien Lucas
Date: 2011/02/07
Robots: noindex,nofollow
Language: en
Tags: debian,tips
*/
# How to create an iso of a CD / DVD

## With dd
```
dd if=/dev/cdrom of=myImage.iso bs=4096k
or
dd if=/dev/dvd of=myImage.iso bs=4096k
```

## With readcd

```
aptitude install cdrecord
umount /media/cdrom0
readcd dev=/dev/dvd f=myImage.iso
```

If you want to have an idea of the speed of readcd, you can add "meshpoints=20 -factor" to your command line. It will output the speed each 5 percent of the process.





