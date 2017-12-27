---
title: "How to connect to an NFS share with Archlinux"
date: 2012-11-05
tags: [archlinux]
slug: archlinux-connect-nfs
aliases: [/en/tips/archlinux-connect-nfs]
---
# How to connect to an NFS share with Archlinux

Easy ;)

```
pacman -S nfs-utils
rc.d start rpcbind
mount 192.168.12.105:/volume1/logiciel dir/
```


