---
title: "Sauvegarder ses photos de famille et les rendre disponible à moindre cout - Partie 1"
date: 2011-08-24
tags: [picasa,synology]
slug: backup-photo-picasaweb
---
# Sauvegarder ses photos de famille et les rendre disponible à moindre cout - Partie 1

## Pourquoi ?
Je dois avoir quelques dizaines de milliers de photos amassées depuis un peu plus de 10 ans pour un total d'environ 15Go. Ces photos ont des résolutions et des caractéristiques différentes (puisque prises avec des appareils photos différents). Mes photos sont actuellement stockées sur un NAS Synology et j'utilise aussi l'application PhotoStation pour générer les miniatures et avoir un site accessible de l'extérieur (voir [Nginx et Photostation](/blog/nginx-synology-photostation)). En parallèle le NAS est sauvegardé toutes les semaines sur un disque externe. Au niveau sauvegarde cela semble correct mais un simple incendie me fait tout perdre.

Pour le partage des photos avec la famille, j'utilise PhotoStation (donc leur accès passe par ma liaison ADSL) mais avec le temps je suis venu à penser que ce n'était pas la meilleure solution. La plupart du temps le besoin est de consulter les photos et donc le fait d'avoir des photos de 12MPixels n'a aucun intérêt. Dans de rare cas, il y a un besoin de télécharger toutes les photos d'un répertoire et dans ce cas je fais un paquet que j'envoie via dl.free.fr.

## Un embryon de solution

Au début je pensais m'acheter un serveur dédié le moins cher possible et au final cela coute environ 20€ par mois ce qui n'est pas négligeable.

J'ai pensé ensuite aux services d'hébergement de photos : Flickr, Picasa Web Albums, etc. Ils ont tous une limite en place avec la possibilité de payer pour avoir plus de place disponible. J'avais lu que Picasa ne prennait pas en compte dans sa limite d'1Go les photos ayant une résolution inférieure à 800. Et avec la mise en ligne de Google+, Google a rehaussé sa limite à une résolution de 2048 pour les possesseurs d'un compte Google+. Et voila j'ai trouvé ma solution miracle qui ne coute que de l'huile de coude et qui peut être fun. En gardant des photos de qualité correcte, cette solution me permet de conserver mes photos dans le cloud (hihi) et de les partager si besoin.

Au niveau sécurité, Picasa Web Album propose 4 niveaux (voir [ici](http://picasa.google.com/support/bin/answer.py?hl=fr&answer=39551)). Pour l'instant je me suis laissé tenter par le niveau "Limitée aux utilisateurs disposant du lien", sachant que je vais tout faire pour cacher le mieux possible le lien.

Le plan de bataille est le suivant :

* Envoyer mes photos en les retaillant à une taille 2048x? en gardant toutes les propriétés Exif
* Garder mon organisation actuelle (une répertoire par date et thème)
* Valider que l'ordre des albums est bien correct (chronologique)
* Faire le nécessaire pour récupérer les informations des albums pour héberger une page Web sur mon serveur avec les liens d'accès.


