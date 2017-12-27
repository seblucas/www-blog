/*
Title: Basic use of rsync
Description: 
Author: Sébastien Lucas
Date: 2011/02/07
Robots: noindex,nofollow
Language: en
Tags: debian,tips
*/
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





