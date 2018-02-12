---
title: "My swap is used a lot but I have ton of free RAM"
date: 2011-02-07
tags: [debian,tips]
slug: swappiness
disqus_identifier: /en/tips/swappiness
aliases: [/en/tips/swappiness]
---
# My swap is used a lot but I have ton of free RAM

There's a parameter called swappiness which control the way the kernel will use swap. It's a value between 0 (only use the swap when there is no memory left) and 100 (try to often offload the memory to the swap) and the default value is 60. This parameter has been heavily discussed : [Kerneltrap](http://kerneltrap.org/node/3000) or [Slashdot](http://developers.slashdot.org/article.pl?sid=04/04/30/1238250).

On my laptop I added this line to my rc.local :

```
echo 10 >/proc/sys/vm/swappiness
```

This allow me to avoid using the swap (and the slow i/o) too often.





