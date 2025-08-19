---
title: "2025 Homelab upgrade - Music"
date: 2025-08-20
tags: [homelab, proxmox]
series: ["2025 Homelab upgrade"]
series_order: 2
---

# Why

I used to use [Foobar2000](https://www.foobar2000.org/) to play my music stored on an SMB share (or directly on my laptop's hard disk). This setup was not ideal, especially with my work laptop. At first, I was the System Administrator, so I was allowed to have music files on my computer. Later, it became a problem. All my colleagues were using cloud music providers, but I was never a big fan of the concept of not owning my music. Still, I wanted to listen to my music on my mobile phone anywhere.

# LMS

After many nights reading about self-hosted music servers, my choice came down to [Navidrome](https://www.navidrome.org/) and [LMS](https://github.com/epoupon/lms). LMS seemed more lightweight, and since I only have around 60 GB of music, it was sufficient for my needs, so that's what I chose.

For now, I use [Ultrasonic](https://gitlab.com/ultrasonic/ultrasonic) on my Android phone, but it seems unmaintained, so I may switch to another app.

# Fixing tags

Installing LMS was very easy (using the Docker image). The real challenge was fixing all the tags in my music files. I used [Picard](https://picard.musicbrainz.org/); it was long and painful, but everything is now tagged correctly except for two unofficial live albums by Dire Straits.

# Where is my data

My data is in my Storage Box:
 * It is available via SMB, so I can still use Foobar2000 on my home laptop and add new albums.
 * It is synced twice a day to my server that hosts LMS (read-only).
 * It is backed up every week to my NAS at home (also read-only).

It's also available via DLNA to use with my Hi-Fi system.