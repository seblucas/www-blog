---
title: "How to reencode a 6 channels AAC file to a proper AC3 file"
date: 2011-02-07
tags: [multimedia]
slug: 6-channels-acc-to-ac3
aliases: [/en/tips/6-channels-acc-to-ac3]
---
# How to reencode a 6 channels AAC file to a proper AC3 file

First why doing that :

*	My home cinema only handle AC3 and DTS.
*	There's no easy way (I know you can special alsa output to do that) to make mplayer reencode the AAC into AC3 during playback
*	AC3 is a much more universal format (at least for now)

You'll need :

*	faad (a simple aptitude install faad will do)
*	aften (see [here](http://aften.sourceforge.net)), you'll need to build it from the sources.

Then the easiest way to avoid having a really big intermediate file is to use a fifo :

```
mkfifo temp.wav
screen -d -m faad -o temp.wav input.aac
aften temp.wav output.ac3
rm temp.wav
```

I use screen to launch faad because to make sure faad and aften are running at the same time (whole purpose of using a fifo), you can also use two terminals.

Note that faad seems to have a problem displaying the correct pourcentage decoded so don't trust it.





