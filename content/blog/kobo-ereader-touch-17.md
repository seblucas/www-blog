/*
Title: Tout ce que vous ne voulez pas savoir sur la Kobo !
Description: 
Author: Sébastien Lucas
Date: 2012/05/29
Robots: noindex,nofollow
Language: fr
Tags: ereader
*/
# Tout ce que vous ne voulez pas savoir sur la Kobo !

## Pourquoi ?
Je pense que c'est clair : je suis Monsieur Marketing car je suis fier de ce titre ! Je persiste : vous n'allez rien apprendre d'utile avec ce billet !

Je vais simplement profiter de ce billet pour traduire en français toute une série d'informations qui restent dans mes favoris depuis quelques semaines et qui sera beaucoup mieux en libre accès sur le Web.

## Le partitionnement de la Kobo

Notre liseuse utilise un linux et pour son stockage interne utilise 2Go de mémoire partitionnée de la façon suivante :
*	/dev/mmcblk0p1 pour la partition root (environ 256Mo)
*	/dev/mmcblk0p2 pour la partition de secours (environ 256Mo)
*	/dev/mmcblk0p3 pour la partition user (environ 1.4Go) pour les livres et le reste de la configuration.
  
Lors d'une remise à zéro (voir [trucs et astuces](/blog/kobo-ereader-touch-5)) la partition de secours est recopiée dans la partition root.

Cela a un intérêt : même en bidouillant comme un dingue la partition root, il n'y a (en théorie) aucun risque de casser définitivement la liseuse tant que la partition de secours est préservée.

## La mémoire interne de la Kobo serait une carte µSD : donc remplaçable

![Image](/blog/kobointerieur.jpg)
J'ai vu sur [le forum de MobileRead](http://www.mobileread.com/forums/showthread.php?t=177676) une photo qui confirmerait cela. Et cette même personne indique qu'elle a réussi à augmenter la taille de sa partition allouée aux livres avec l'outil gparted. J'y vois surtout l'avantage de pouvoir la remplacer si nécessaire. 

Ma pauvre liseuse fonctionne encore parfaitement pour la lecture mais le navigateur ne fonctionne plus du tout même après une remise à zéro. Si cela est du à des blocs défectueux sur la carte comme je le crains, je peux garder l'espoir de la changer et même de prendre une carte plus rapide pour donner un coup de boost à la Kobo.

Attention : cette information n'est pas confirmée à 100% pour toutes les liseuses, lorsque j'aurais eu l'inconscience de l'ouvrir et de vérifier par mes propres yeux je posterai une mise à jour.

## Carte µSD et type de système de fichier

J'ai pu tester les systèmes de fichiers suivants :
*	FAT32 : OK
*	ext3 : OK
*	ext4 : OK
*	NTFS : NOK

## Carte µSD externe et partitionnement

La Kobo ne supporte pas les carte µSD formatée sans table de partition (en mode superfloppy). Donc si vous avez totalement remis à zéro une carte µSD, pensez à bien recréer la partition.

Sous Linux :
```bash
#adjust /sdd to be your device
#check its unmounted by Nautilus
udisks --unmount /dev/sdd1
#wipe it
dd if=/dev/zero of=/dev/sdd bs=1M
#use full card size with first partition
fdisk -H255 -S63 /dev/sdd
#manually eject it now so kernel updates with partition
#format it, in this case ext4
mkfs.ext4 /dev/sdd1
#stop wasting reserved space
tune2fs /dev/sdd1 -m0 -O sparse_super -L "8Gb KOBO"
#turn journal off as flash
tune2fs -O ^has_journal /dev/sdd1
```

Source : http://www.richud.com/wiki/Kobo_eReader_touch

## Personnaliser l'écran de veille

Alors c'est encore plus chaud que tout le reste mais cela reste amusant. Un utilisateur de Kobo a ajouté son nom sur l'écran de veille de la Kobo afin d'être certain de ne pas confondre sa liseuse avec celle de son épouse. Cela implique l'édition binaire d'un exécutable de la Kobo.

*	Mettre en place les accès telnet et ftp.
*	Récupérer la bibliothèque nickel sur la Kobo :
```bash
    ftp kobo
    cd /usr/local/Kobo
    get libnickel.so.1.0.0
```
*	A l'aide d'un éditeur binaire recherche la chaine de caractères "Sleep Mode" et il faut la remplacer celle de votre choix. Attention : ne pas changer la taille totale de la chaine (compléter par des espaces si nécessaire). Ici l'exemple avec "Chuck" :
```
    010E0160  65 70 69 6E 67 2D 62 6C 61 63 6B 2E 70 6E 67 00 eping-black.png.
    010E0170  66 6F 6E 74 3A 20 69 74 61 6C 69 63 20 34 34 70 font: italic 44p
    010E0180  78 20 47 65 6F 72 67 69 61 20 3B 00 20 43 68 75 x Georgia ;. Chu
    010E0190  63 6B 27 73 20 00 00 00 51 57 69 64 67 65 74 20 ck's ...QWidget
    010E01A0  7B 20 63 6F 6C 6F 72 3A 20 72 67 62 28 32 35 35 { color: rgb(255 
```
*	Transmettre le fichier modifié sur la Kobo
```bash
    ftp kobo
    cd /usr/local/Kobo
    put libnickel.so.1.0.0
```
*	Redémarrer la liseuse (par le petit bouton et un trombone)

Source : http://mountain-tech.net/tech/embedded/kobo/
