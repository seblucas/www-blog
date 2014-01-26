/*
Title: How to force the uninstall of an MSI
Description: 
Author: Sébastien Lucas
Date: 2013/04/08
Robots: noindex,nofollow
Language: en
Tags: windows
*/
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


