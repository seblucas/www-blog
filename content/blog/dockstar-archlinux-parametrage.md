/*
Title: Paramétrage d'Archlinux sur le Dockstar
Description: 
Author: Sébastien Lucas
Date: 2012/05/23
Robots: noindex,nofollow
*/
# Paramétrage d'Archlinux sur le Dockstar

## Référence
Mes principales sources d'informations ont été un post très documenté sur forum.hardware.fr (voir [ici](http://forum.hardware.fr/hfr/OSAlternatifs/Hardware-2/seagate-dockstar-computer-sujet_71314_83.htm#t1306553)) et le wiki d'Archlinux (https://wiki.archlinux.org/index.php/Main_Page) qui est assez bien fait.

A suivre un tutoriel sur l'installation d'OpenVPN.

## Après l'installation

### Principe
Beaucoup, beaucoup de choses se paramètrent dans le fichier /etc/rc.conf c'est assez déstabilisant quand on vient de Debian.
### Changement du Hostname

Il se change dans le fichier rc.conf :

	
	HOSTNAME="minus"

### Réglage de l'heure

#### Pourquoi ?
Le Dockstar ne possède pas d'horloge interne il faut donc passer par un NTP pour avoir une date et heure correcte.
#### Fuseau horaire

Encore une fois, on édite le rc.conf :

	
	TIMEZONE="Europe/Paris"

#### NTP

*	Installation

	
	pacman -S ntp


*	Synchronisation

	
	ntpd -qg


*	Mise en place en mode démon (en éditant le rc.conf)

	
	DAEMONS=(... !hwclock ntpd ...)

### Langue

*	Vérification des locales installées

	
	locale -a


*	Ajout des locales manquantes (en éditant /etc/locale.gen)

	
	en_US.UTF-8 UTF-8
	en_US ISO-8859-1
	de_DE ISO-8859-1
	de_DE@euro ISO-8859-15
	fr_FR.UTF-8 UTF-8
	fr_FR ISO-8859-1


*	Re-génération

	
	locale-gen


*	Édition du rc.conf

	
	LOCALE="fr_FR.UTF-8"

### Mise en place du noatime

Le fichier fstab avant l'installation ressemble à ça

	
	#
	# /etc/fstab: static file system information
	#
	# `<file system>` `<dir>`   `<type>`  `<options>`       `<dump>`  `<pass>`
	tmpfs           /tmp    tmpfs   nodev,nosuid    0       0


On récupère donc le UUID de notre partition / avec la commande suivante :

	
	blkid


et on peut ensuite modifier le fstab :

	
	#
	# /etc/fstab: static file system information
	#
	# `<file system>` `<dir>`   `<type>`  `<options>`       `<dump>`  `<pass>`
	UUID="xx"       /       ext2    defaults,noatime 0       1
	tmpfs           /tmp    tmpfs   nodev,nosuid     0       0

## Commandes utiles

### Mise à jour du système

	
	pacman -Syyuf



