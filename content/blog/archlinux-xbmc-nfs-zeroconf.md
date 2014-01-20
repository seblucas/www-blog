/*
Title: Faciliter l'intégration des partages NFS dans XBMC
Description: 
Author: Sébastien Lucas
Date: 2013/01/14
Robots: noindex,nofollow
Language: fr
Tags: archlinux,xbmc
*/
# Faciliter l'intégration des partages NFS dans XBMC

Comme indiqué dans mon précédent article sur le sujet (voir [Partager un répertoire NFS vers XBMC](/blog/archlinux-xbmc-nfs)), le principal problème est que je n'avais pas trouvé de moyen de ne pas saisir manuellement le chemin du partage. J'ai enfin trouvé quelque chose avec Zeroconf.

## Installation de Avahi (équivalent de Zeronconf)

```
pacman -S avahi
```
## Ajout du partage NFS

Ajouter le fichier suivant dans /etc/avahi/services :
```
`<?xml version="1.0" standalone='no'?>`
 `<!DOCTYPE service-group SYSTEM "avahi-service.dtd">`
 `<service-group>`
   `<name replace-wildcards="yes">`NFS partage on %h`</name>`
   `<service>`
     `<type>`_nfs._tcp`</type>`
     `<port>`2049`</port>`
     `<txt-record>`path=/home/user/partage`</txt-record>`
   `</service>`
 `</service-group>`
```
## Démarrer les services

```
rc.d start dbus
rc.d start avahi-daemon
```

Ne pas hésiter à ajouter ces deux démons dans la section DAEMONS du fichier rc.conf.
## Bilan

Avec cette méthode le partage apparait dans le Zeroconf browser de XBMC donc plus de saisie manuelle !

Par contre je n'ai toujours pas trouvé le moyen de le faire apparaitre dans l'autodétection de partage NFS.
