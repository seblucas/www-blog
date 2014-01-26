/*
Title: How to use an Xbox remote with OpenElec on a Raspberry Pi
Description: 
Author: Sébastien Lucas
Date: 2012/10/15
Robots: noindex,nofollow
Language: en
Tags: rpi,xbmc
*/
# How to use an Xbox remote with OpenElec on a Raspberry Pi

Thanks to a [recent commit](https://github.com/OpenELEC/OpenELEC.tv/issues/783) all the modules are built in. All that remains is some configuration.

## Add Lircd configuration

Connect to your Pi with ssh and copy + paste (or download) following code in /storage/.config/lircd.conf :
```
begin remote

name  XboxDVDDongle
bits            8
eps            30
aeps          100

one             0     0
zero            0     0
gap          163983
toggle_bit_mask 0x0

begin codes
LEFT                     0xA9
UP                       0xA6
RIGHT                    0xA8
DOWN                     0xA7
SELECT                   0x0B
1                        0xCE
2                        0xCD
3                        0xCC
4                        0xCB
5                        0xCA
6                        0xC9
7                        0xC8
8                        0xC7
9                        0xC6
0                        0xCF
MENU                     0xF7
DISPLAY                  0xD5
REVERSE                  0xE2
FORWARD                  0xE3
PLAY                     0xEA
PAUSE                    0xE6
STOP                     0xE0
SKIP-                    0xDD
SKIP+                    0xDF
TITLE                    0xE5
INFO                     0xC3
BACK                     0xD8
end codes

end remote
```

## Fix lircd command line

The easiest way I found is to add create an autoexec.sh file : 
```
vi /storage/.config/autostart.sh
chmod +x /storage/.config/autostart.sh
```

Don't forget to paste these lines in the autoexec : 
```
#!/bin/sh

killall -9 lircd
/usr/sbin/lircd --driver=default --device=/dev/lirc0 --uinput \
--output=/var/run/lirc/lircd \
--pidfile=/var/run/lirc/lircd-lirc0.pid \
/storage/.config/lircd.conf
```

## Reboot

```
reboot
```

## Source

*	https://github.com/OpenELEC/OpenELEC.tv/issues/783
*	http://openelec.tv/forum/124-raspberry-pi/42030-solved-help-xbox-dvd-kit

