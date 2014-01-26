/*
Title: Linux n'a pas besoin de defragmenteur ......
Description: 
Author: Sébastien Lucas
Date: 2010/10/02
Robots: noindex,nofollow
Language: fr
Tags: debian
*/
# Linux n'a pas besoin de defragmenteur ......

Eh bien si 

## Pourquoi ce billet

Tout simplement pour éviter de dégouter à vie des personnes de Linux à cause de mensonges ou d'idées reçues sans fondement. J'ai déjà entendu qu'un PII-400 avec Linux peut parfaitement jouer tous les Divx (et même certains H264) ..... Ce que je réponds est que cela peut être vrai (MPlayer avec une Matrox sur un PII 400 peut jouer quasiment tous les Divx normaux) mais que cela peut aussi être faux (tout dépends du matériel et de la complexité de la vidéo). C'est pourquoi j'ai démarré ce billet pour rationaliser un peu.

## Une partition sous Linux peut être fragmenté

On m'a même expliqué (je l'ai même cru pendant un moment) qu'il y avait un petit démon qui tournait automatiquement quand les io étaient faibles pour défragmenter tout seul. Il est vrai que ext3 (le système de fichier principal de Linux) n'a pas d'outil pour défragmenter mais étrangement il existe des scripts pour détecter la fragmentation (voir [ici](http://www2.lut.fi/~ilonen/ext3_fragmentation.html)). Donc ext3 (et tous les autres systèmes de fichier que je connais) peuvent aussi se fragmenter (comme NTFS ou FAT32). Si vous avez une partition presque pleine avec pas mal de création/suppression/modification de fichiers (quelques apt-get upgrade de temps en temps par exemple) elle va certainement être beaucoup fragmentée.

La vérité est que la plupart des systèmes de fichier sous Linux sont moins sensible à la fragmentation à cause de leur usage du cache et l'écriture retardée. Et il existe (IIRC) un seul système de fichier qui a une défragmenteur en ligne (Pas besoin de démonter ses partitions pour l'utiliser) : c'est XFS avec xfs_fsr. Il semblerait que ext4 va avoir un outil similaire.

Donc cette affirmation est fausse : Même les systèmes de fichiers Linux peuvent devenir fragmentés et la fragmentation n'est un problème Windows uniquement.

