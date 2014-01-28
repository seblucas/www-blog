/*
Title: Installer Debian Lenny
Description: 
Author: Sébastien Lucas
Robots: noindex,nofollow
Language: fr
Tags: lenny
*/
# Installer Debian Lenny

## Téléchargement de l'ISO
J'ai préféré prendre un version très récente car la beta 2 ne boote pas sur mon ordinateur (très très vieux) :
[Lenny Netinst](http://cdimage.debian.org/cdimage/daily-builds/daily/arch-latest/i386/iso-cd/)

## Installation basique

### Exécution de l'installeur
Pour l'installation j'ai pris tout les éléments par défaut en décochant l'installation de l'interface graphique ce qui permet d'avoir un système minimal.

La documentation officielle Debian est [ici](http://d-i.alioth.debian.org/manual/fr.i386/index.html)

Ne pas hésiter à installer Grub sur le MBR, l'installateur détecte l'éventuel Windows installé et il sera toujours bootable après l'installation.

### Premier démarrage

En premier on met à jour les paquets :

```
apt-get update
```

Et on installe le paquet apt-listbugs qui permet de d'être informé avant chaque mise à jour automatique si le paquet téléchargé est exempt de problème (Lenny est pour l'instant en testing) :

```
apt-get install apt-listbugs
```

On finit par installer les paquets de base sans qui toute vie linuxienne est impossible :

```
apt-get install bzip2 ssh build-essential
```

Quelques petites explications :
*	bzip2 : outils de compression (plus efficace que gzip). 
*	ssh : permet de se connecter à distance en ssh. sous Window je conseille l'excellent [PuTTY](http://www.chiark.greenend.org.uk/~sgtatham/putty/).
*	build-essential : installe le nécessaire pour pouvoir compiler n'importe quel programme C/C++ (cpp, gcc, g++).


