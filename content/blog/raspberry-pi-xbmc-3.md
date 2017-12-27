---
title: "XBMC sur le Raspberry PI - Quelques trucs"
date: 2012-10-18
tags: [rpi,xbmc]
slug: raspberry-pi-xbmc-3
---
# XBMC sur le Raspberry PI - Quelques trucs

Un minuscule article sur des choses déjà mondialement connues mais que j'ai cherché certainement trop longtemps.

## Télécommande XBOX sur OpenElec

J'ai fait l'article en anglais mais cela devrait être lisible par tous :
[How to use an Xbox remote with OpenElec on a Raspberry Pi](/blog/raspberry-pi-openelec-xbox-dongle)

## Accéder à des partages NFS sur un NAS Synology

Bizarrement cela ne fonctionne pas nativement. Comme le protocole NFS est censé être plus efficace que SAMBA, j'ai creusé un peu plus pour trouver [ça](http://wiki.xbmc.org/index.php?title=NFS#Synology). En résumé il faut :

* Activer l'accès SSH sur le NAS
* Se connecter en SSH (root / mot de passe du compte admin)
* Modifier /etc/exports (avec vi par exemple) pour remplacer "insecure_locks" par "insecure"
* redémarrer le nas ou exécuter la commande suivante : 

```
exportfs -ra
```

## advancedsettings.xml

Ce fichier permet de faire des modifications dans le comportement d'XBMC. Pour tous les détails, vous pouvez voir [ici](http://wiki.xbmc.org/index.php?title=Userdata/advancedsettings.xml). Les paramètres qui j'ai trouvé intéressants sont :

* `<cachemembuffersize>`5242880`</cachemembuffersize>` : Taille en octet de la mémoire tampon (RAM).
* `<algorithmdirtyregions>`1`</algorithmdirtyregions>` : Pour améliorer le nombre de FPS.



