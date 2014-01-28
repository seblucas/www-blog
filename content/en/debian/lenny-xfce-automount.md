/*
Title: Automount with XFCE and Lenny
Description: 
Author: Sébastien Lucas
Robots: noindex,nofollow
Language: en
Tags: lenny,xfce
*/
# Automount with XFCE and Lenny

## Preliminary
Most of the following is only usefull with Lenny, With Squeeze everything seems to work out of the box.

## How does it work

XFCE use [hal](http://www.freedesktop.org/wiki/Software/hal) to handle CD, DVD, flash drive, USB hard-disk drive, ... anything removable. It should be installed by default (I don't remember installing anything to get it running). With XFCE, if you insert a DVD in your drive you'll get a new icon in your desktop (and your device is already mounted). If you right click on this icon you can either unmount or eject it.

For information everything is mounted in /media.

## Configuration

## General
Add yourself to the plugdev group :

```
gpasswd -a userName plugdev
```

You can check all the groups you're in by running :

```
id
```

## CD / DVD

I honestly don't remember if it's needed at all but I also added two more groups :

```
gpasswd -a userName cdrom
gpasswd -a userName floppy
```

## Thunar volume manager

[Volume manager](http://foo-projects.org/~benny/projects/thunar-volman/index.html) is Thunar plugin to interact with removable media. You can install it easily :

```
apt-get install thunar-volman
```

You can then configure it within thunar or in the XFCE menu (parameters). You can mimick Windows way to automatically start an audio player, a video player, ... I don't like that a lot so I just configured it to start xfburn when I insert a blank DVD-R.

![Image](/en/debian/volman.png)

## The NTFS case

## Why NTFS ?
Because I have friends... friends with Windows XP / Vista. So for them, the interest of an USB hard drive formatted in ext3, XFS or JFS is still to be found.

## NTFS-3G

Linux kernel only contains a read-only driver for NTFS. But thanks to fuse, [NTFS-3G](http://www.ntfs-3g.org/) brings us a stable read / write NTFS driver. You can install it easily :

```
apt-get install ntfs-3g
```

## Problem

The problem is that if I connect my NTFS USB drive it is perfectly mounted but :
*	with the ntfs read only kernel driver,
*	and only root has the permission to read on it.

## Solution (almost clean)

The idea came from [here](http://gentoo-wiki.com/HOWTO_NTFS_write_with_ntfs-3g#Adding_.2Fsbin.2Fmount.ntfs_is_more_easier_.28hal-0.5.9.1_or_later.29), I simplified it a little :

```
su -
cd /sbin
ln -s mount.ntfs-3g mount.ntfs
```

And it works.

