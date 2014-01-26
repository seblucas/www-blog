/*
Title: Utiliser une clé USB pour démarrer Debian - Partie 2
Description: 
Author: Sébastien Lucas
Date: 2011/04/09
Robots: noindex,nofollow
Language: fr
Tags: debian,grub
*/
# Utiliser une clé USB pour démarrer Debian - Partie 2

## Pourquoi ?
J'avais déjà fait le nécessaire avec Grub4dos (voir [Utiliser une clé USB pour démarrer Debian](/blog/grub4dos-usb-debian)) mais malheureusement j'ai été maladroit et cette clé n'est plus de ce monde. Au final il ne me reste plus qu'un vieille clé de 32Mo surlaquelle il est impossible d'installer Grub4dos donc j'ai du retenter d'installer Grub2.

## Installation de Grub2

### Préparation de la clé
Insérer la clé sur votre ordinateur, utiliser la commande suivante pour déterminer le device utilisé (dans mon cas /dev/sdb) :
```
dmesg | tail
```
S'arranger pour avoir une et une seule partition de type linux et bootable (avec fdisk) et la formater :
```
mkfs.ext2 /dev/sdb1
```

### Installation de Grub2

```
grub-install --force --no-floppy --root-directory=/media/disk /dev/sdb
```
remplacer /media/disk par le point de montage de /dev/sdb1.

A partir de ce moment, la clé doit être bootable il reste à ajouter le menu.

## Paramétrage de Grub2

Copier le fichier grub.cfg dans le répertoire /media/disk/boot/grub :
```
menuentry "Grub Direct" {
        insmod ext2
        set root='(hd1,msdos4)'
        multiboot /boot/grub/core.img
}
```






