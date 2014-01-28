/*
Title: How to connect to an NFS share with Archlinux
Description: 
Author: Sébastien Lucas
Date: 2012/11/05
Robots: noindex,nofollow
Language: en
Tags: archlinux
*/
# How to connect to an NFS share with Archlinux

Easy ;)

```
pacman -S nfs-utils
rc.d start rpcbind
mount 192.168.12.105:/volume1/logiciel dir/
```


