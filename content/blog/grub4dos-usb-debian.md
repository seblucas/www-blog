---
title: "Utiliser une clé USB pour démarrer Debian"
date: 2010-11-12
tags: [debian,grub]
slug: grub4dos-usb-debian
---
# Utiliser une clé USB pour démarrer Debian

## Pourquoi ?
Je voulais installer Debian sur un ordinateur portable mais en étant certain de ne pas perturber l'installation de Windows existante. J'ai donc installer ma Debian Squeeze normalement mais dans installer Grub dans le MBR (donc sans virer le bootloader de Windows). Le plan était d'utiliser une clé USB pour démarrer Debian.

## Installation de Grub sur la clé

Je n'ai pas réussi à faire fonctionner cette solution. Si quelqu'un a une idée je suis preneur.

## Installation de Grub4dos sur la clé

Télécharger les éléments suivants :

* http://download.gna.org/grubutil/grubinst-1.1-bin-w32-2008-01-01.zip
* http://download.gna.org/grub4dos/grub4dos-0.4.4-2009-06-20.zip

Insérer la clé USB sous Windows.

Décompresser GrubInst et faire l'installation avec la GUI (grubinst_gui.exe) si cela ne fonctionne pas alors exécuter la commande suivante :

```
grubinst.exe --skip-mbr-test (hd1)
```
Remplacer hd1 par le point de montage de votre clé USB.

Décompresser grub4dos et copier les fichiers sur la clé USB :

* grldr
* menu.lst

## Modification du menu.lst

### Méthode "en dur"

```
title Start Squeeze
root (hd1,3)
kernel /boot/grub/core.img
```
Ici on accède directement à la bonne partition (4ième du deuxième disque) et on charge grub.

### Méthode automatique

```
title Find and load Grub
find --set-root --ignore-floppies /boot/grub/core.img
map () (hd0)
map (hd0) ()
map --rehook
find --set-root --ignore-floppies /boot/grub/core.img
kernel /boot/grub/core.img
savedefault --wait=2
```
Ici on demande à grub4dos de chercher sur les partitions le fichier /boot/grub/core.img et une fois trouvé de le lancer.

Cette méthode permet de pouvoir redémarrer un Linux donc le grub aurait été effacé par une installation de XP par exemple.

### Fun : charger geexbox

```
title geexbox-2.0-alpha2-en.i386.eglibc.iso
map --sectors-per-track=0 --heads=0 /geexbox-2.0-alpha2-en.i386.eglibc.iso (0xFF) || map --mem --sectors-per-track=0 --heads=0 /geexbox-2.0-alpha2-en.i386.eglibc.iso (0xFF)
map --hook
root (0xFF)
chainloader (0xFF)
```
Il faut bien sur ajouter le fichier /geexbox-2.0-alpha2-en.i386.eglibc.iso à la racine de la clé USB.

### Fichier complet

```-
# This is a sample menu.lst file. You should make some changes to it.
# The old install method of booting via the stage-files has been removed.
# Please install GRLDR boot strap code to MBR with the bootlace.com
# utility under DOS/Win9x or Linux.

color blue/green yellow/red white/magenta white/magenta
timeout 10
default 3

title find and load NTLDR of Windows NT/2K/XP
fallback 1
find --set-root --ignore-floppies --ignore-cd /ntldr
map () (hd0)
map (hd0) ()
map --rehook
find --set-root --ignore-floppies --ignore-cd /ntldr
chainloader /ntldr
savedefault --wait=2

title find and load BOOTMGR of Windows VISTA
fallback 2
find --set-root --ignore-floppies --ignore-cd /bootmgr
map () (hd0)
map (hd0) ()
map --rehook
find --set-root --ignore-floppies --ignore-cd /bootmgr
chainloader /bootmgr
savedefault --wait=2

title Squeeze
root (hd1,3)
kernel /boot/grub/core.img

title Find and load Grub
find --set-root --ignore-floppies /boot/grub/core.img
map () (hd0)
map (hd0) ()
map --rehook
find --set-root --ignore-floppies /boot/grub/core.img
kernel /boot/grub/core.img
savedefault --wait=2

title find and load IO.SYS of Windows 9x/Me
fallback 4
find --set-root /io.sys
chainloader /io.sys
savedefault --wait=2

title commandline
commandline

title floppy (fd0)
chainloader (fd0)+1
rootnoverify (fd0)

title back to dos
quit

title reboot
reboot

title halt
halt

```





