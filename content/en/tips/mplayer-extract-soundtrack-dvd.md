/*
Title: Extract the soundtrack of a DVD
Description: 
Author: Sébastien Lucas
Date: 2011/02/07
Robots: noindex,nofollow
Language: en
Tags: multimedia,tips
*/
# Extract the soundtrack of a DVD

*	Get the aid (audio id) of the wanted soundtrack

```
mplayer -vc null -vo null -identify VTS_01_0.IFO
```
*	Get a stream.dump file (or use -dumpfile to specify the filename)

```
mplayer -vc null -vo null -aid 129 -dumpaudio VTS_01_0.IFO
```





