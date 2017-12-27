---
title: "Applications utiles"
date: 2012-11-10
tags: [xfce,xorg]
slug: xfce-applications
aliases: [/fr/debian/xfce-applications]
---
# Applications utiles

## Emulateur de terminal

XFCE inclus [Terminal](http://www.os-cillation.com/index.php?id=42&L=5) qui logiquement est installé par défaut

## Editeur de texte

XFCE inclus [Mousepad](http://www.xfce.org/projects/mousepad/) qui est l'équivalent du bloc notes de Windows. Il est à installer séparément :

```
apt-get install mousepad
```

## Gestionnaire d'archives

Il y a aussi des outils XFCE pour gérer les archives. il y a [Squeeze](http://squeeze.xfce.org/) qui est un gestionnaire d'archive et il y a aussi un plugin pour Thunar qui permet d'avoir un menu contextuel bien utile. La commande suivante installe les deux outils :

```
apt-get install thunar-archive-plugin
```

## Lecteur d'image

XFCE inclus [Ristretto](http://goodies.xfce.org/projects/applications/ristretto) qui est un lecteur d'image très simple. Il est à installer séparément :

```
apt-get install ristretto
```

Si vous avez le besoin de modifier des images, il faut installer l'excellent [GIMP](http://www.gimp.org/)

```
apt-get install gimp
```

## Graver CD / DVD

On va encore une fois utiliser un outil XFCE : [Xfburn](http://www.xfce.org/projects/xfburn/)

```
apt-get install xfburn
```

## Client FTP

Je conseille [gFTP](http://gftp.seul.org/) qui est simple et qui n'a que très peu de dépendances

```
apt-get install gftp
```

## Navigateur Internet

## Midori
La navigateur officiel de Xfce est Midori. J'ai créé une page spécifique [Midori : l'autre navigateur Web](/fr/debian/squeeze-midori).

## Iceweasel

Evidemment Firefox qui sous Debian s'appelle [IceWeasel](http://fr.wikipedia.org/wiki/IceWeasel) :

```
apt-get install iceweasel iceweasel-l10n-fr
```

## Flash player

Avant il existait un paquet flashplugin-nonfree qui permettait l'installation avec un simple apt-get. Je ne l'ai pas retrouvé sur Lenny, j'ai donc du l'installer avec l'installateur officiel d'Adobe :

```
su -
cd 
wget http://fpdownload.macromedia.com/get/flashplayer/current/install_flash_player_9_linux.tar.gz
tar xvzf install_flash_player_9_linux.tar.gz
cd install_flash_player_9_linux
./flashplayer-installer
```

L'installation est faite par root (su -), elle sera donc globale. La seule question posée par le programme d'installation est  :

```
Please enter the installation path of the Mozilla, Netscape, or Opera browser (i.e., /usr/lib/mozilla): 
```

Il faut réponde : /usr/lib/iceweasel.

## Torrent

Il y a évidemment [Azureus](http://azureus.sourceforge.net/) (maintenant Vuze), mais comme je préfère quelque chose de plus simple, mon choix s'est porté sur [Deluge](http://deluge-torrent.org/) :

```
apt-get install deluge-torrent
```

## Media player

Ici il y a deux possibilités.

## xfmedia

Utiliser [xfmedia](http://spuriousinterrupt.org/projects/xfmedia) basé sur xine :

```
apt-get install xfmedia
```

## MPlayer

Personnellement je préfère installer [MPlayer](http://www.mplayerhq.hu) en compilant les sources.
Voir [ici](/fr/debian/mplayer).

## Prise de contrôle à distance

Voir [ici](/fr/debian/nomachine) pour l'installation de [NoMachine](http://www.nomachine.com/).

## NZB downloader

J'aime beaucoup [SABnzbd](http://sabnzbd.wikidot.com/). C'est simple à installer et il fonctionne parfaitement avec l'IPV6.

Il n'y a pas de paquets tout fait, il faut donc l'installer "à l'ancienne"  :

*	Il faut d'abord mettre les sources d'apt pour inclure les paquet "non-free". Editer le ficher /etc/apt/sources.list pour qu'il ressemble à ça :

```
#
# deb cdrom:[Debian GNU/Linux testing _Lenny_ - Official Beta i386 NETINST Binary-1 20080705-09:34]/ lenny main

#deb cdrom:[Debian GNU/Linux testing _Lenny_ - Official Beta i386 NETINST Binary-1 20080705-09:34]/ lenny main

deb http://ftp.fr.debian.org/debian/ lenny main contrib non-free
deb-src http://ftp.fr.debian.org/debian/ lenny main

deb http://security.debian.org/ lenny/updates main contrib non-free
deb-src http://security.debian.org/ lenny/updates main
```

*	Suivre [ce tutoriel Ubuntu](http://sabnzbd.wikidot.com/install-ubuntuserver804)

## Calculatrice

Je trouve que [galculator](http://galculator.sourceforge.net/) est simple et léger.

```
apt-get install galculator
```

## Moniteur systême

Voir [ici](/fr/debian/conky) pour l'installation de [Conky](http://conky.sourceforge.net/).

## Voisinage réseau (windows, linux, mac)

Après pas mal de tests et de déceptions, j'ai trouvé Gigolo. Plus de détail [ici](/fr/debian/squeeze-gigolo).

