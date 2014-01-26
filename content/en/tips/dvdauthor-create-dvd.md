/*
Title: How to create a dvd structure with a mpg file
Description: 
Author: Sébastien Lucas
Date: 2011/02/07
Robots: noindex,nofollow
Language: en
Tags: multimedia,tips
*/
# How to create a dvd structure with a mpg file

First, you'll need dvdauthor : 

```
aptitude install dvdauthor
```

Next, you'll have to create an xml (file.xml) file for dvdauthor :

```
<dvdauthor>
    <vmgm />
    <titleset>
        <titles>
            <pgc>
                <vob file="file.mpg" />
            </pgc>
        </titles>
    </titleset>
</dvdauthor>
```

Finally, launch dvdauthor and wait, you'll have a directory with AUDIO_TS and VIDEO_TS structure :

```
dvdauthor -o file -x file.xml
```





