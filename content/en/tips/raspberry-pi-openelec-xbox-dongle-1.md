/*
Title: How to use an Xbox remote with OpenElec on a Raspberry Pi (Update 04/2014)
Description: 
Author: Sébastien Lucas
Date: 2014/04/11
Robots: noindex,nofollow
Language: en
Tags: rpi,xbmc
*/
# How to use an Xbox remote with OpenElec on a Raspberry Pi (Update 04/2014)

Lately, I upgraded to a newer version of OpenElec compiled by MilhouseVH coming from [this thread](http://forum.xbmc.org/showthread.php?tid=184866).

[The previous tutorial](/en/tips/raspberry-pi-openelec-xbox-dongle) didn't work. In addition to it, I had to change the content of `autostart.sh` to that :

```bash
modprobe lirc_xbox
killall -9 lircd

/usr/sbin/lircd --driver=default --device=/dev/lirc0 --uinput \
--output=/run/lirc/lircd \
--pidfile=/var/run/lirc/lircd-lirc0.pid \
/storage/.config/lircd.conf
```

I also modified `/storage/.config/modprobe.d/disable-spdif-for-hd-audio.conf` to add :

```
blacklist lirc_rpi
```

I didn't need the module but I've not tested my tweak without it.