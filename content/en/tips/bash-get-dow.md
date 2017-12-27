---
title: "How to get the day of week with bash/sh"
date: 2011-05-19
tags: [tips]
slug: bash-get-dow
aliases: [/en/tips/bash-get-dow]
---
# How to get the day of week with bash/sh

*	Localized day of week : 

```
#!/bin/sh
DOW=$(date +"%a")
echo $DOW
```

*	In english :

```
#!/bin/sh
LANG=C DOW=$(date +"%a")
echo $DOW
```

If you want to get current month, year, ... replace %a by anything found [here](http://www.cyberciti.biz/faq/linux-unix-formatting-dates-for-display/)






