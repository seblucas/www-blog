---
title: "How to update the date & time with ntp"
date: 2017-04-03
tags: [debian]
slug: update-ntp-date-and-time
aliases: [/en/tips/update-ntp-date-and-time]
---
# How to update the date & time with ntp

```
sudo service ntpd stop
sudo ntpd -gq
sudo service ntpd start
```

Another easier way :

```
sudo sntp -s pool.ntp.org
```
