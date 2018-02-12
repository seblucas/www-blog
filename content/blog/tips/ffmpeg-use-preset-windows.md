---
title: "How to use FFmpeg presets with Windows"
date: 2011-03-01
tags: [multimedia]
slug: ffmpeg-use-preset-windows
disqus_identifier: /en/tips/ffmpeg-use-preset-windows
aliases: [/en/tips/ffmpeg-use-preset-windows]
---
# How to use FFmpeg presets with Windows

It's used for example to ease x264 encoding.

*	Create a directory named .ffmpeg within C:\DirectoryWhereYourPresetAreInstalled where you can put all your preset
*	Execute the following script

```
set HOME=C:\DirectoryWhereYourPresetAreInstalled
ffmpeg -i "%1" -acodec copy -s 1280x720 -vcodec libx264 -vpre default -nr 300 -crf 20 -threads 0  "%1.mkv"

set HOME=
```






