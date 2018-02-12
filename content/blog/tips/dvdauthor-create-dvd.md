---
title: "How to create a dvd structure with a mpg file"
date: 2011-02-07
tags: [multimedia,tips]
slug: dvdauthor-create-dvd
disqus_identifier: /en/tips/dvdauthor-create-dvd
aliases: [/en/tips/dvdauthor-create-dvd]
---
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





