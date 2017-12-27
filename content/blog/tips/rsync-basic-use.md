---
title: "Basic use of rsync"
date: 2011-02-07
tags: [debian,tips]
slug: rsync-basic-use
disqus_identifier: /en/tips/rsync-basic-use
aliases: [/en/tips/rsync-basic-use]
---
# Basic use of rsync

*	Mirror two directories :

```
rsync -av --progress SourceDir/ DestinationDir/
```

*	Mirror two directories with compression :

```
rsync -avz --progress SourceDir/ DestinationDir/
```

*	Mirro two directories and delete in destination what's been deleted in source (real mirroring) :

```
rsync -avz --progress --delete --delete-after SourceDir/ DestinationDir/
```





