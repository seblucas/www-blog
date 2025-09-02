---
title: "How to encode an existing audio track to aac"
date: 2011-02-07
tags: [multimedia,tips]
slug: stereo-to-neroaac
disqus_identifier: /en/tips/stereo-to-neroaac
aliases: [/en/tips/stereo-to-neroaac]
---
# How to encode an existing audio track to aac

```bash
#!/bin/sh
mkfifo temp.wav
screen -d -m mplayer "$1" -vc null -vo null -ao pcm:fast:waveheader:file=temp.wav
./neroAacEnc -ignorelength -q 0.30 -if temp.wav -of "$1.aac"
rm temp.wav
```

I use screen but you can also use & or two terminals.

Sometimes mplayer is too worried about seeks and don't work so you can use ffmpeg instead : 

```bash
#!/bin/sh
mkfifo temp.wav
screen -d -m ffmpeg -i "$1" -y -acodec pcm_s16le -f wav -ar 48000 temp.wav 
./neroAacEnc -ignorelength -q 0.30 -if temp.wav -of "$1.aac"
rm temp.wav 
```

Beware the -y is very important to allow ffmpeg to overwrite the fifo file.

