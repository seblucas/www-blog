/*
Title: Installation de la branche de Glandos de Tvheadend pour le RTSP
Description: 
Author: Sébastien Lucas
Date: 2013/04/12
Robots: noindex,nofollow
Language: fr
Tags: dockstar,freebox,rpi,xbmc
*/
# Installation de la branche de Glandos de Tvheadend pour le RTSP

## Quoi ?
Merci de lire [Nouvelles d'OpenElec / Tvheadend / Raspberry Pi](/blog/raspberry-pi-xbmc-8) pour mieux comprendre de quoi ça parle.
En pratique cela permet d'accéder aux flux RTSP de la Freebox.

## Téléchargement et compilation

### Prérequis
Il vous faut :
*	Un environnement de compilation
*	Git

###  Téléchargement 

```
git clone git://github.com/Glandos/tvheadend.git
cd tvheadend/
```

### Positionnement sur la bonne branche

```
git checkout -b iptv_rtsp remotes/origin/iptv_rtsp
```

### Configuration & Compilation

```
configure && make
```
le résultat de la compilation se trouve dans le répertoire build.linux.

### Installation et/ou paramétrage

Je n'ai pas voulu voulu passer par la case installation (make install) pour garder le tout dans un seul répertoire. J'ai donc tout mis en place dans le répertoire build.linux : 

```
cd build.linux/src/webui
ln -s ../../../src/webui/static/ static
cd ../..
./tvheadend
```
Et tout devrait fonctionner sans erreur, vous devriez pouvoir aller sur l'adresse suivante pour configurer Tvheadend :

```
http://<votre ip>:9981/
```

## Paramétrage de XBMC

Je n'ai pas trouvé mieux que [le Wiki officiel](http://wiki.xbmc.org/index.php?title=PVR).

## Après

C'est un peu brut, je sais, je pense que je ferai un article complémentaire plus didactique par la suite.
