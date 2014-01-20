/*
Title: Raspberry Pi VS Dockstar : Le combat
Description: 
Author: Sébastien Lucas
Date: 2012/09/23
Robots: noindex,nofollow
Language: fr
Tags: dockstar,rpi
*/
# Raspberry Pi VS Dockstar : Le combat

J'avais déjà lu que le choix du CPU du Raspberry Pi était critiqué pour sa technologie ARM11 et aussi pour sa faible fréquence (700MHz). J'ai donc décidé de faire un petit benchmark rapide.

Je me suis basé sur ce [post](http://www.raspberrypi.org/phpBB3/viewtopic.php?f=63&t=16397) sur le forum officiel du Raspberry Pi.

Sur un Dockstar (avec un Archlinux et noyau 3.1.10-13) :
```
time echo "scale=2000; 4*a(1)" | bc -l
...
real    0m13.814s
user    0m13.770s
sys     0m0.010s
```

Sur un Raspberry Pi (avec Raspbian et le noyau 3.1.9-test-12-06) avec overclock à 840MHz et aucun service actif :
```
time echo "scale=2000; 4*a(1)" | bc -l
...
real    0m20.451s
user    0m20.400s
sys     0m0.010s
```

Pour les deux mesures j'ai lancé 5 fois la commande à la suite et j'ai pris le meilleur des résultats.

Bilan : avec cette comparaison basique, le Raspberry Pi est presque deux fois moins rapide que le Dockstar. Je suis d'accord que la puissance brute du CPU ne représente pas l'intérêt global du RPi mais cela permet de relativiser.

Je ferai un nouveau billet quand j'aurai mis à jour le noyau de ces deux machines.


