---
title: "Update a Dockstar uImage/uInitrd after a kernel update"
date: 2011-02-07
tags: [dockstar,tips]
slug: dockstar-update-uimage-uinitrd
disqus_identifier: /en/tips/dockstar-update-uimage-uinitrd
aliases: [/en/tips/dockstar-update-uimage-uinitrd]
---
# Update a Dockstar uImage/uInitrd after a kernel update

```
/usr/bin/mkimage -A arm -O linux -T kernel  -C none -a 0x00008000 -e 0x00008000 -n Linux-2.6.32-5 -d /boot/vmlinuz-2.6.32-5-kirkwood /boot/uImage
/usr/bin/mkimage -A arm -O linux -T ramdisk -C gzip -a 0x00000000 -e 0x00000000 -n initramfs -d /boot/initrd.img-2.6.32-5-kirkwood /boot/uInitrd
```







