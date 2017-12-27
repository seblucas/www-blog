---
title: "Error in Eclipse with Android Emulator"
date: 2011-02-07
tags: [android]
slug: android-java-ipv6
disqus_identifier: /en/tips/android-java-ipv6
aliases: [/en/tips/android-java-ipv6]
---
# Error in Eclipse with Android Emulator

 * Error (DDMS) :

```
57:29 E/DeviceMonitor: Connection attempts: 1
57:30 E/DeviceMonitor: Connection attempts: 2
...
```

 * Solution (quick and dirty solution) :

```
sysctl -w net.ipv6.bindv6only=0
```

 * Smarter solution (see http://www.mail-archive.com/android-developers@googlegroups.com/msg88955.html) : Adding the jvm argument -Djava.net.preferIPv4Stack=true to both the ddms shell script and the eclipse.ini vm arguments. It has the advantage to fix java and not the system.

Edit 07/17/2011 : Another solution is to uninstall openjdk and gcj and install the officiel jdk from sun/oracle.





