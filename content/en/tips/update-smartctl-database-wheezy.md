---
title: "How to update smartctl database with Debian Wheezy"
date: 2014-11-01
tags: [debian]
slug: update-smartctl-database-wheezy
aliases: [/en/tips/update-smartctl-database-wheezy]
---
# How to update smartctl database with Debian Wheezy

You'll have to create run these commands :

```bash
#!/bin/bash

UPDATE=/usr/sbin/update-smart-drivedb
if [ -f "$UPDATE" ]; then
 sed -i "/^SRCEXPR/{s#=.*#='http://sourceforge.net/p/smartmontools/code/HEAD/tree/\$location/smartmontools/drivedb.h?format=raw'#}" $UPDATE
fi
```

before running `update-smart-drivedb `

Source :

 * http://debianforum.de/forum/viewtopic.php?f=27&t=146361#p964092

