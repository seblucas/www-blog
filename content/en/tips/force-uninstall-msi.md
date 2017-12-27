---
title: "How to force the uninstall of an MSI"
date: 2013-04-08
tags: [windows]
slug: force-uninstall-msi
aliases: [/en/tips/force-uninstall-msi]
---
# How to force the uninstall of an MSI

I got the following message : 

Another version of this product is already installed

After a while, I finally found [this post](http://stackoverflow.com/questions/2991286/visual-studio-packaging-another-version-of-this-product-is-already-installed) :

*	Execute :

```
msiexec /i program_name.msi /lv logfile.log
```

*	Find the GUID (look for Product Code from property table before transforms: '{GUID}')
*	Zap it

```
msizap.exe TWP {GUID}
```

I found msizap [here](http://nerdoftherings.net/wp/?p=66)


