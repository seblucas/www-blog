/*
Title: Partager un répertoire NFS vers XBMC
Description: 
Author: Sébastien Lucas
Date: 2013/01/07
Robots: noindex,nofollow
Language: fr
*/
# Partager un répertoire NFS vers XBMC

Comme je n'ai pas trouvé beaucoup d’informations sur le sujet, un petit billet sur les partages NFS.

## Paramétrage de Archlinux

### Installation des paquets
```
pacman -S nfs-utils
```
### Démarrage des services

```
rc.d start rpcbind
rc.d start nfs-common
rc.d start nfs-server
```
Pour éviter de les démarrer à la main à chaque reboot, il faut ajouter dans le fichier /etc/rc.conf (section DAEMONS).
### Paramétrage des répertoires à exporter

J'ai modifié le fichier /etc/exports pour ajouter la ligne suivantes : 
```
/home/user/partage 192.168.0.9(rw,insecure,all_squash)
```

Quelques explications :

*	192.168.0.9 : c'est l'IP de mon Raspberry Pi.

*	rw : Pour l'instant même avec cela mon partage est en lecture seule, j'ai certainement d'autres choses à paramétrer (uid ?).

*	insecure,all_squash : cela semble nécessaire pour XBMC.

A noter qu'après avoir modifié le fichier il faut lancer la commande suivante pour mettre à jour les répertoires exportés :
```
exportfs -arv
```
## Paramétrage de XBMC

La détection automatique des partages NFS n'a pas fonctionné chez moi. J'ai donc saisi à la main mon partage :
```
nfs://192.168.0.106//home/user/partage
```

Cela fonctionne bien mais je ne sais vraiment pas pourquoi l'autodetection ne marche pas, si quelqu'un a des informations merci de me l'indiquer dans les commentaires.
