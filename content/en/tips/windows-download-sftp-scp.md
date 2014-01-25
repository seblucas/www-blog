/*
Title: How to download a file on a SFTP / SCP Linux server with Windows
Description: 
Author: Sébastien Lucas
Date: 2011/06/10
Robots: noindex,nofollow
Language: en
Tags: tips,windows
*/
# How to download a file on a SFTP / SCP Linux server with Windows

*	Get pscp.exe : http://www.chiark.greenend.org.uk/~sgtatham/putty/download.html

*	Create a batch file like this :
```
pscp.exe -P PORT -batch -pw PASSWORD USER@HOST:DIRECTORY/FILE .
```

Note that the directory is relative to the home directory of the user used.






