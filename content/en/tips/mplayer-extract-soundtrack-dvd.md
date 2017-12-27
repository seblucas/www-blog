---
title: "Extract the soundtrack of a DVD"
date: 2011-02-07
tags: [multimedia,tips]
slug: mplayer-extract-soundtrack-dvd
aliases: [/en/tips/mplayer-extract-soundtrack-dvd]
---
# Extract the soundtrack of a DVD

*	Get the aid (audio id) of the wanted soundtrack

```
mplayer -vc null -vo null -identify VTS_01_0.IFO
```

*	Get a stream.dump file (or use -dumpfile to specify the filename)

```
mplayer -vc null -vo null -aid 129 -dumpaudio VTS_01_0.IFO
```





