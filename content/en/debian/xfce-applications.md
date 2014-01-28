/*
Title: Useful applications
Description: 
Author: Sébastien Lucas
Robots: noindex,nofollow
Language: en
Tags: xfce,xorg
*/
## Useful applications

### XTerm
XFCE include [Terminal](http://www.os-cillation.com/index.php?id=42&L=5) which should already been installed.

### Text editor

XFCE include [Mousepad](http://www.xfce.org/projects/mousepad/) which is basically Windows's Notepad. You'll have to install it :

```
apt-get install mousepad
```

### Archive manager

There is also XFCE tools to help you deal with archives. There is [Squeeze](http://squeeze.xfce.org/) which is an archive manager and there's also a plugin to Thunar (Xfce file manager) which bring a helpful contextual menu to compress/uncompress. The following command install both tools :

```
apt-get install thunar-archive-plugin
```

### Image viewer

XFCE include [Ristretto](http://goodies.xfce.org/projects/applications/ristretto) which is very light image viewer. You'll have to install it :

```
apt-get install ristretto
```

If you need to modify images (not only view them), you'll need [GIMP](http://www.gimp.org/) :

```
apt-get install gimp
```

### Burn CD / DVD

We'll use yet another XFCE tool : [Xfburn](http://www.xfce.org/projects/xfburn/).

```
apt-get install xfburn
```

### FTP client

I prefer [gFTP](http://gftp.seul.org/) because it's very easy and it has almost no dependancies.

```
apt-get install gftp
```

### Internet browser

Of course Firefox which is called [IceWeasel](http://fr.wikipedia.org/wiki/IceWeasel) in Debian (change fr with your language) :

```
apt-get install iceweasel iceweasel-l10n-fr
```

### Flash player

Before there was a flashplugin-nonfree package. I didn't manage to find it in Lenny so I installed it with the official installer from adobe :

```
su -
cd 
wget http://fpdownload.macromedia.com/get/flashplayer/current/install_flash_player_9_linux.tar.gz
tar xvzf install_flash_player_9_linux.tar.gz
cd install_flash_player_9_linux
./flashplayer-installer
```

The installation is made by root (su -) so it will make a global install. The only question the installer will ask is :

```
Please enter the installation path of the Mozilla, Netscape, or Opera browser (i.e., /usr/lib/mozilla): 
```

You'll have to answer : /usr/lib/iceweasel

### Torrent

There is of course [Azureus](http://azureus.sourceforge.net/) (now Vuze), but I prefer something lighter, my choice is [Deluge](http://deluge-torrent.org/) :

```
apt-get install deluge-torrent
```

### Media player

There are two choices.

#### xfmedia

Use [xfmedia](http://spuriousinterrupt.org/projects/xfmedia) based on xine :

```
apt-get install xfmedia
```

#### MPlayer

Personnally I prefer to install [MPlayer](http://www.mplayerhq.hu) by compiling the sources.
See [here](/en/debian/mplayer).

### Remote administration

See [here](/en/debian/nomachine) for the installation of [NoMachine](http://www.nomachine.com/).

### NZB downloader

I really like [SABnzbd](http://sabnzbd.wikidot.com/). It's easy to setup and it works with [ IPV6](/[en/debian-ipv6 )].

There is no all-in-one package for debian so you'll have to install it the hard way :
*	update your apt sources to include non-free packages. Edit your /etc/apt/sources.list so it looks like that :

```
#
# deb cdrom:[Debian GNU/Linux testing _Lenny_ - Official Beta i386 NETINST Binary-1 20080705-09:34]/ lenny main

#deb cdrom:[Debian GNU/Linux testing _Lenny_ - Official Beta i386 NETINST Binary-1 20080705-09:34]/ lenny main

deb http://ftp.fr.debian.org/debian/ lenny main contrib non-free
deb-src http://ftp.fr.debian.org/debian/ lenny main

deb http://security.debian.org/ lenny/updates main contrib non-free
deb-src http://security.debian.org/ lenny/updates main
```

*	follow this [howto for Ubuntu](http://sabnzbd.wikidot.com/install-ubuntuserver804)

### Calculator

I personally like [galculator](http://galculator.sourceforge.net/).

```
apt-get install galculator
```

### System monitor

See [here](/en/debian/conky) for the installation of [Conky](http://conky.sourceforge.net/).

