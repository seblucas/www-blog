---
title: "Banana Pi - Dissipation thermique"
date: 2014-11-03
tags: [bpi]
slug: banana-pi-6-dissipation-thermique
disqus_identifier: /blog/banana-pi-6-dissipation-thermique
---
# Banana Pi - Dissipation thermique

## Pourquoi ?

Quand j'ai regardé pour la première fois les images du Banana Pi j'ai vu que le SOC (le processeur pour faire simple) est situé sur la face inférieure de la carte (vous pouvez vérifier [les photos vous même](http://fr.wikipedia.org/wiki/Banana_Pi)). Comme vous le savez la chaleur monte donc la conception du Banana Pi n'aide pas à avoir une évacuation naturelle de la chaleur.

Quand j'ai installé le Banana Pi dans son boîtier je ne me suis pas posé de question, j'ai juste pensé à le surélever pour que la partie ajourée ne soit pas bouchée.

## Quelques mesures

Je n'ai pas fait un travail très scientifique sur le sujet, j'ai juste fait quelques mesures avec une charge CPU nulle (100% idle) :

 * Boîtier en position normale (CPU en dessous) : CPU : 42°C / PMU : 43°C.
 * Boîtier en position verticale (SATA en haut) : CPU : 40°C / PMU : 42°C.
 * Boîtier en position verticale + Radiateur sur le SOC : CPU : 38°C / PMU : 39°C.

Il y a un [post intéressant de tkaiser sur le forum LeMaker](http://forum.lemaker.org/forum.php?mod=redirect&goto=findpost&ptid=8137&pid=37492&fromuid=14202) sur ce sujet avec une courbe issue de [RPI-Monitor](banana-pi-5-rpi-monitor).

Comme j'utilise à la fois la [caméra](banana-pi-4-camera-prise-en-main) et les port GPIO (j'ai des articles à venir sur le sujet) je n'ai pas essayé de le mettre à l'envers.

## Bilan

Si votre Banana Pi est dans endroit clos sans aération naturelle, pensez à le mettre en position verticale.