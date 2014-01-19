/*
Title: Installation d'une Debian Squeeze sur un Seagate Dockstar
Description: 
Author: Sébastien Lucas
Date: 2011/09/16
Robots: noindex,nofollow
*/
# Installation d'une Debian Squeeze sur un Seagate Dockstar

## Seagate Dockstar
### Historique

Cela faisait des années que je suivais tout ce qui concernait les [PlugComputer](http://fr.wikipedia.org/wiki/Special:Search?search=PlugComputer), notamment les [SheevaPlug](http://fr.wikipedia.org/wiki/Special:Search?search=SheevaPlug) et les [BeagleBoard](http://fr.wikipedia.org/wiki/Special:Search?search=BeagleBoard). Et en juillet suite à un post sur http://forum.hardware.fr, j'ai fini par acheter sur un site en ligne un superbe Dockstar ([Lien officiel](http://www.seagate.com/www/fr-fr/products/network_storage/freeagent_dockstar/)) pour le prix modique de 18,95€. 

### Hardware

Il a les caractéristiques suivantes :

*	Processeur ARM Marvell Kirkwood 1,2 GHz (Feroceon)

*	128Mo de RAM

*	256Mo de mémoire Flash NAND (32Mo occupés par le logiciel officiel)

*	3 ports USB

*	1 port mini-USB (dock)

*	1 port Ethernet Gigabit

En pratique on a la puissance d'un PIII-600 mais sans unité de calcul de nombre flottant.
### A quoi ça sert

Dans mon cas j'ai plusieurs objectifs :

*	Un site web (vous y êtes) avec un wiki/blog

*	Un enregistreur TNT (avec une clé TNT et l'enregistrement sur un NAS grâce à VDR)

*	Un serveur [DLNA](http://fr.wikipedia.org/wiki/Special:Search?search=DLNA) avec mediatomb ou minidlna

*	Un serveur d'impression (Pour une imprimante USB)

*	Un serveur de fichier (Samba)

*	Un serveur OpenVPN

*	Un lecteur de musique connecté à un système HIFI (avec une carte son USB).

*	...
### Consommation électrique

Mon Wattmètre qui a une précision de 4W m'indique ...... 0W. J'en déduis donc que le Dockstar + une clé USB de 8Go consomment environ 4W.
## Installation

Tout ce qui va suivre est une honteuse copie/ré-interprétation de la documentation de ce lien : http://forum.hardware.fr/hfr/OSAlternatifs/Hardware-2/seagate-dockstar-computer-sujet_71314_1.htm.
### Désactiver les mises à jour

Le système est paramétré pour se mettre à jour dès qu'il est connecté sur internet, il est donc primordial de désactiver les mises à jour avant tout. Personnellement je l'ai connecté avec le câble fourni sur mon portable ce qui fait qu'il va avoir une adresse du style 169.254.0.0/16 (il est aussi possible de déconnecter l'ADSL de son routeur mais j'ai choisi la méthode complexe). La prochaine étape est donc de trouver son IP :

*	Avec nmap :
```
nmap -e eth0 -sP 169.254.0.0/16
```

*	Avec netdiscover :
```
netdiscover -r 169.254.0.0/16 -P
```
Une fois l'adresse IP trouvée il faut se connecter en SSH et exécuter les commandes suivantes :

*	Monter le système en lecture/écriture
```
mount / -rw -o remount
```

*	Modifier le /etc/hosts pour bloquer les mises à jour
```
127.0.0.1 service.pogoplug.com
127.0.0.1 pm2.pogoplug.com
127.0.0.1 service.cloudengines.com
127.0.0.1 upgrade.pogoplug.com
```

*	Remettre le système en lecture seule
```
mount / -r -o remount
```
### Installation de Debian Squeeze

C'est simple il suffit de suivre le tutoriel de Jeff Doozan : http://jeff.doozan.com/debian/

Personnellement j'ai fait l'installation sur une clé USB de 8Go que j'ai partitionnée avec le système Pogoplug (fdisk est dans /sbin). Je me suis prévu 256Mo de swap que je n'ai jamais monté pour le moment (pas d'intérêt).
## Liens utiles

*	Topic sur hardware.fr : http://forum.hardware.fr/hfr/OSAlternatifs/Hardware-2/seagate-dockstar-computer-sujet_71314_1.htm

*	Forum de Jeff Doozan : http://forum.doozan.com/

*	Forum de plugapps : http://plugapps.com/forum/index.php

*	Ajout de l'I2C, port SDHC, RTC, ... : http://plugapps.com/forum/viewtopic.php?f=6&t=258

*	Boot NFS avec le Dockstar : http://hippopota.me/blog/?p=740

*	Connexion JTAG : http://www.yourwarrantyisvoid.com/2010/09/08/dead-dockstar-resurrected-with-jtag/ 

*	Un wiki bien fait : http://www.rudiswiki.de/wiki/DockStarDebian

*	Post en allemand avec des circuit imprimés additionnels : http://www.mikrocontroller.net/topic/187115

*	Wiki en allemand : http://www.mikrocontroller.net/articles/Dockstar

*	Un forum en français dédié aux plugcomputers : http://www.forum-plugcomputer.net

*	Un wiki sur les Sheeva et autres plugs : http://plug.maisondouf.fr/

