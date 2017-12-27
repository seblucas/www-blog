---
title: "How to download a file on a SFTP / SCP Linux server with Windows"
date: 2011-06-10
tags: [tips,windows]
slug: windows-download-sftp-scp
aliases: [/en/tips/windows-download-sftp-scp]
---
# How to download a file on a SFTP / SCP Linux server with Windows

*	Get pscp.exe : http://www.chiark.greenend.org.uk/~sgtatham/putty/download.html
*	Create a batch file like this :

```
pscp.exe -P PORT -batch -pw PASSWORD USER@HOST:DIRECTORY/FILE .
```

Note that the directory is relative to the home directory of the user used.






