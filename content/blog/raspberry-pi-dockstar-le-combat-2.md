---
title: "Raspberry Pi VS Dockstar : Le combat II"
date: 2012-09-23
tags: [dockstar,rpi]
slug: raspberry-pi-dockstar-le-combat-2
---
# Raspberry Pi VS Dockstar : Le combat II

Suite une remarque d'un lecteur sur mon [précédent test](/blog/raspberry-pi-dockstar-le-combat) et à la sortie de modifications importantes sur la distribution Raspbian (voir [ici](http://www.raspberrypi.org/archives/2008)), j'ai refait quelques mesures.

Je tiens encore à préciser que ce tests permet juste de déceler une tendance, le ARM Cortex A8 du A10 est un processeur beaucoup plus évolué que le Feroceon du Dockstar pourtant vous verrez que leur résultats sont similaires.

## Raspberry Pi

Tous les tests ont été fait sur une Raspbian minimaliste avec très peu de services. Le firmware a été mis à jour aujourd'hui (via rpi-update). J'ai donc testé les différents niveaux d'overclock proposés (sauf le dernier qui plante chez moi).

Modest 800MHz ARM, 300MHz core, 400MHz SDRAM, 0 overvolt 

```
real    0m20.686s
user    0m20.620s
sys     0m0.010s
```

Medium 900MHz ARM, 333MHz core, 450MHz SDRAM, 2 overvolt

```
real    0m18.458s
user    0m18.400s
sys     0m0.020s
```

High   950MHz ARM, 450MHz core, 450MHz SDRAM, 6 overvolt

```
real    0m17.399s
user    0m17.350s
sys     0m0.020s
```

L'overclock apporte donc un gain certain. Je m'attendais à une différence plus important vu qu'un bug sur l'USB a été corrigé (censé apporter ~10% de performance), mais c'est déjà ça !

## Dockstar en noyau 3.5.4

Aucune différence :

```
real    0m13.782s
user    0m13.750s
sys     0m0.000s
```

## Melee A2000 (Allwinner A10)

J'en avais déjà parlé dans un précédent article (voir [Deux Dockstar ... et après](/blog/dockstar-raspberry-pi-a10)), voila donc le résultat d'un A10 à 1GHz (ARM Cortex A8) : 

```
real    0m13.968s
user    0m13.960s
sys     0m0.000s
```
