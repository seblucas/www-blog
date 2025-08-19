---
title: "2025 Homelab upgrade - Music"
date: 2025-08-20
tags: [homelab,proxmox]
series: ["2025 Homelab upgrade"]
series_order: 2
---

# Why

I was used to use [Foobar2000](https://www.foobar2000.org/) with my music on a SMB share (or directly in my laptop hard disk). I was not ideal with my work laptop, at first I was the Sytem Administrator ... So I was allowed to have music file on my computer. Then, it became a problem. All my colleagues were using Cloud music provider but I never was a big fan of the concept of not owning my music. But I still wanted to listen to my music on my mobile phone anywhere.

# LMS

After many nights reading about selfhosted music containers, it became a choice between [Navidrome](https://www.navidrome.org/) and [LMS](https://github.com/epoupon/lms). LMS seemed more lightweight and I only have around 60Gb of music so not a lot, so that's what I chose.

For now I use [Ultrasonic](https://gitlab.com/ultrasonic/ultrasonic) for my Android phone but it seemed unmaintained so I may change.

# Fix tagging

LMS installation was very easy (using the docker image), the real problem was to fix all the tags of my current file. I used [Picard](https://picard.musicbrainz.org/), it was long and painful but everything excluding two non official live album of Dire Straits.

# Where is my data

My data is in my Storage Box :
 * is available with SMB -> so I can still use Foobar2000 on my home laptop and add new albums.
 * is synched 2 times a day to my server that hosts LMS (readonly).
 * is backed up every week to my NAS at home (also readonly).

It's also available to DLNA to use with my Hi-Fi system.