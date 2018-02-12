---
title: "Install Debian Lenny"
date: 2012-11-10
tags: [lenny]
slug: lenny-install
aliases: [/en/debian/lenny-install]
---
# Install Debian Lenny

## ISO download
I downloaded a nightly build because the beta 2 wasn't booting with my computer (very old) :
[Lenny Netinst](http://cdimage.debian.org/cdimage/daily-builds/daily/arch-latest/i386/iso-cd/)

## Basic installation

### Starting the installer
I pretty much followed all the default stuff of the installation. The only difference is at the end I did not choose the Graphical environment to get a basic system.

The official Debian documentation is [here](http://d-i.alioth.debian.org/manual/fr.i386/index.html) if you need help.

Do not be scared to install Grub in the MBR, the installer perfectly detect any Windows you could have and I can testify it's still bootable afterwards.

### First start

First you got to update the list of the package available :

```
apt-get update
```

Then we install the package apt-listbugs which allow to be informed of any bug pending when installing an update (For now Lenny is still in  testing) :

```
apt-get install apt-listbugs
```

We finish by installing mandatory package (there is no Linux life possible without them) :

```
apt-get install bzip2 ssh build-essential
```

Some explanations :

*	bzip2 : compressing tool (it can compress better than gzip, but is slower). 
*	ssh : allow you to connect remotely with a crypted connection. With Windows I advise you to get [PuTTY](http://www.chiark.greenend.org.uk/~sgtatham/putty/).
*	build-essential : install everything needed to compile anything in C/C++ (cpp, gcc, g++).

