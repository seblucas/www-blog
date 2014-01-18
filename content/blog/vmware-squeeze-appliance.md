/*
Title: Appliance / Image Debian Squeeze pour VMware
Description: 
Author: Sébastien Lucas
Date: 2011/09/25
Robots: noindex,nofollow
*/
# Appliance / Image Debian Squeeze pour VMware

## Versions utilisées

*	VMware player 3.1.2 pour amd64.

*	Installer Debian Squeeze (http://cdimage.debian.org/cdimage/daily-builds/daily/arch-latest/i386/iso-cd/debian-testing-i386-netinst.iso) du 05/10/2010.

*	VMware tools 8.4.4.
## Spécificités de l'installation

J'ai installé une version minimale de Squeeze avec le serveur SSH, donc pas de Xorg pour cette version. J'ai aussi pris les choix suivants :

*	Le compte root a pour mot de passe : route

*	Pas de compte user

*	La carte réseau est en DHCP

*	Seules les locales suivantes sont installées :
    * fr_FR.utf8
    * en_US.utf8

*	Le disque est partitionné comme cela :
    * Partition primaire 1 : 256Mo de swap
    * Partition primaire 2 : ~7,5Go en ext4

Après cette installation j'ai installé les paquets suivants (pour compiler les VMware tools) :
```
aptitude install --without-recommends linux-headers-2.6-686
```
Après la compilation et l'installation des VMware tools j'en ai supprimé les sources.

## Compression pour mise à disposition

Dans le but de mettre à disposition l'appliance, j'ai fait un maximum de ménage pour réduire la taille totale du paquet. J'ai ensuite utilisé ce howto : http://www.howtoforge.com/how-to-shrink-vmware-virtual-disk-files-vmdk. 
```
aptitude clean
aptitude autoclean
cat /dev/zero > zero.fill;sync;sleep 1;sync;rm -f zero.fill
```
La dernière commande permet d'être certain que l'espace libre du disque virtuel est bien composé de 0 pour faciliter la compression.

Le fichier compressé a ensuite été obtenu comme suit :
```
7za a -t7z -m0=lzma -mx=8 -mfb=64 -md=32m -ms=on SqueezeMinimal.7z SqueezeMinimal/
```
## Téléchargement

http://dl.free.fr/n9E2zCz4f

Ce fichier fait environ 184Mo. Il est à décompresser avec 7zip (http://www.7-zip.org/) sous Windows ou avec cette commande :
```
7za x SqueezeMinimal.7z
```

