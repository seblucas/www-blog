---
title: "Le voisinage réseau sous Debian : merci à Gigolo"
date: 2012-11-10
tags: [debian,xfce]
slug: squeeze-gigolo
aliases: [/fr/debian/squeeze-gigolo]
---
# Le voisinage réseau sous Debian : merci à Gigolo

## Etat de l'art
J'ai passé beaucoup de temps à recherche un outil graphique me permettant de retrouver l'équivalent du voisinage réseau de Windows. J'ai testé les outils suivants :

*	[pyNeibourhood](https://launchpad.net/pyneighborhood)
*	[linneightbourhood](http://www.bnro.de/~schmidjo/)
*	[fusesmb](http://www.ricardis.tudelft.nl/~vincent/fusesmb/)
*	...

Jusqu'au jour ou j'ai trouvé Gigolo qui correspond exactement à ce que je veux.

## Gigolo

Liens intéressants :

*	Site officiel : http://www.uvena.de/gigolo/
*	Page Ubuntu en français : http://doc.ubuntu-fr.org/gigolo
*	

## Installation de Gigolo

Ce n'est pas forcement si simple que d'habitude : 

*	Installer les paquets

```
aptitude install gigolo gvfs-backends gvfs-fuse
```

*	Ajouter son utilisateur dans le groupe fuse

```
gpasswd -a MonUser fuse
```

*	S'assurer que le module fuse est bien chargé (à faire en root)

```
modprobe fuse
```

*	Si vous avez autant de bol que moi, essayez une déconnexion/reconnexion.

## Configuration

La configuration par défaut est bonne, la seule chose que j'ai fait concerne l'affichage du panneau latéral qui permet d'accéder au réseau SMB complet.

## Cas du NFS

Gigolo ne permet pas de monter du NFS. J'ai donc défini mes points de montage dans /etc/fstab en les spécifiant accessible aux utilisateurs :

```
192.168.1.125:/volume1/video /home/vlad/mount/nas nfs noauto,user,rw 0 0
```

Ces points de montage apparaissent directement dans Gigolo. Une fois que le fstab est modifié ensuite tout tourne tout seul.

