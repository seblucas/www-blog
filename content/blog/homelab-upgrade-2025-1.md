---
title: "2025 Homelab upgrade - Before"
date: 2025-08-19
tags: [homelab,proxmox]
series: ["2025 Homelab upgrade"]
series_order: 1
---

# Goal of my homelab

## Share / download video and music

I was using [Minidlna](https://en.opensuse.org/MiniDLNA) to share media to my TVs (DLNA compatible), Kodi (installed on Android TV devices or laptops), and BubbleUpnp for mobile phones.

For the download part: Nzbget, Pyload, ...

Music was shared with an SMB share (to use with foobar2000) and with DLNA for the Hi-Fi system.

## Handle IOT / Temperature and hygrometry

I have many temperature / hygrometry sensors around the house (mainly attached to ESP8266 / ESP32) sending data every 5 minutes to a [Mosquitto](https://mosquitto.org/) MQTT hub.

I also have many small Python programs sending data (smart thermostat, security system, electricity and gas consumption, ...) to this MQTT hub and a bigger one aggregating data and storing it in a Firebase database.

# Hardware

Everything above was happily running on an [Orange Pi Plus 2E](http://www.orangepi.org/html/hardWare/computerAndMicrocontrollers/details/Orange-Pi-Plus-2E.html) so: 
 * AllWinner H3 SoC with Quad-core Cortex-A7
 * 2GB of RAM
 * 16GB eMMC Flash (for the OS)
 * Gigabit Ethernet port

So between 10 and 25 Docker containers with 2GB of RAM and I never had a problem. My wattmeter cannot measure less than 6W consumption and when idle it showed 0W (so let's say 6W); with enough load it goes up to 11W.

I added a 512GB SSD with a USB2 adapter to store the media files. Copying to and from this SSD was painful (limited to USB2 bandwidth), but eventually you learn to plan ahead for any big file copy.

NZBGet, especially during par2 and unrar, was clearly limited by the small CPU power but again it got the job done. Download speed was fast enough, especially after tweaking the article cache size.

I also connected a USB CD Drive to automatically rip it and converting it to FLAC.

# External access

This entire stack was in 2 docker compose files and [Traefik](https://traefik.io/) was my reverse proxy of choice with a Let's Encrypt

# Backup

The configuration of every Docker container was backuped to a [Storage Box](https://www.hetzner.com/storage/storage-box/) every night ().

The important media data is rsynched every week to the same Storage box.

