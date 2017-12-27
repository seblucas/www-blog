/*
Title: Slow write with Perc H200 and VMWare ESXi
Description: 
Author: Sébastien Lucas
Date: 2011/05/16
Robots: noindex,nofollow
Language: en
Tags: tips,vmware
*/
# Slow write with Perc H200 and VMWare ESXi

## Problem
I just bought a small Dell server Poweredge 110 II. I was all about saving money and keeping ESXi compatibility so I choose the Perc H200 as the raid card with 2 SATA drives.

The installation works perfectly to the point where it feeled that many of my virtual machines were spending a lot of time in iowait. I started to make some test and finally found out that I had very very very slow writes : 12Mo/s. Yes you read well, I bought an additionnal raid card (Perc H200) to have a write speed that lame (any 10 year old IDE drive can do better).

After a lot of googling I found out I was not the only one (some guy said that it took 1,5 week to create an RAID 1 array of 1TB). Dell officially explains that as the Përc H200 does not have a battery, it does not use any cache (so far understandable) and it disables disk cache (unbelievable).

I also tried to update the firmware or find some hidden option but without any luck. As my main use of this server was ESXi and I didn't wand to invest in a Perc H700 (with BBU), I continued the search.

## Solution

### French power !!!!
I found in a [french forum](http://forum.online.net/index.php?/topic/316-en-cas-de-performances-degradees-de-votre-h200-assurez-vous-de-lactivation-du-cache-disque-sata/page__p__1328__hl__h200__fromsearch__1#entry1328) a way to enable the disk cache. It should not harm your data (at least not mine), but do a backup before. So here is a quick translation.

### Get Ubuntu

Download the latest Ubuntu CD for amd64. In my case : ubuntu-11.04-desktop-amd64.iso.

### Modification

*	Boot the CD
*	Choose your language and click Try Ubuntu
*	Start a command line (Application -> Accessories -> Terminal)
*	Install and configure the tools

```
sudo echo 'deb http://linux.dell.com/repo/community/deb/latest /' | sudo tee -a /etc/apt/sources.list.d/linux.dell.com.sources.list

sudo apt-get update
sudo apt-get install -y --force-yes srvadmin-base
sudo apt-get install -y --force-yes srvadmin-storageservices

sudo service dataeng start
```

*	Check if the disk cache is disabled

```
sudo /opt/dell/srvadmin/bin/omreport storage vdisk | grep 'Disk Cache Policy'
```

*	If you already got : **Disk Cache Policy : Enabled** then sorry there's nothing I can do for you.
*	Otherwise try this command to enable the cache (it's persistent across reboot) :

```
sudo /opt/dell/srvadmin/sbin/omconfig storage vdisk  action=changepolicy controller=0 vdisk=0 diskcachepolicy=enabled
```

In my case I went back to a write speed of 90Mo/s. Way better!

Hope this helps !






