---
title: "How to properly test Nokia 5110 display (PCD 8544)"
date: 2016-03-14
tags: [arduino,rpi,bpi]
slug: testing-pcd8544-display
disqus_identifier: /en/tips/testing-pcd8544-display
aliases: [/en/tips/testing-pcd8544-display]
---
# How to properly test Nokia 5110 display (PCD 8544)

## With WiringPi (software spi)

http://binerry.de/post/25787954149/pcd8544-library-for-raspberry-pi
https://github.com/binerry/RaspberryPi/tree/master/libraries/c/PCD8544

## Caveats

Blue pcb -> LED has to be Up to have backlight.

Specs : http://skpang.co.uk/catalog/images/lcd/graphic/docs/User_Manual_ET_LCD5110.pdf

With some displays (coming from china), there might be some tweaks needed :

 * changing LCD bias mode from 0x14 to 0x15 or even 0x17
 * Tweaking the contrast (LCD Vop)
 * Putting everything to low before starting anything

http://forum.arduino.cc/index.php?topic=148359.0
http://forum.arduino.cc/index.php?topic=197299.0
http://forum.arduino.cc/index.php?topic=229873.0
http://playground.arduino.cc/Code/PCD8544
https://github.com/bbx10/esp-pcd-bitcoin









