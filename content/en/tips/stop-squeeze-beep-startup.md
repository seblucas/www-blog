---
title: "How to stop the startup beep with Debian Squeeze"
date: 2011-07-01
tags: [debian,tips]
slug: stop-squeeze-beep-startup
aliases: [/en/tips/stop-squeeze-beep-startup]
---
# How to stop the startup beep with Debian Squeeze

By googling for an answer, I found out that the most popular way was to blacklist the module pcspkr :

```
echo "blacklist pcspkr" >> /etc/modprobe.d/blacklist.conf
```

Unfortunately it hasn't worked for me. In mt case I had to execute my favorite mixer (xfce-mixer) et mute PC-Beep.







