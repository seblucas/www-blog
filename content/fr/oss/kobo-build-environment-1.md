/*
Title: Création d'un environnement de compilation Kobo - Partie 1
Description: 
Author: Sébastien Lucas
Robots: noindex,nofollow
Language: fr
Tags: ereader
*/
# Création d'un environnement de compilation Kobo - Partie 1

## Pourquoi ?
Depuis que le plugin Kobo a été créé, je me suis demandé comment le compiler moi même et à terme comment modifier le plugin pour ajouter des fonctionnalités sans l'aide de personne.

Cette première partie expliquera comment installer le compilateur. Les parties suivantes aborderont la compilation des bibliothèques Kobo et je terminerai par la compilation du plugin (si j'arrive à le faire).
## Contexte

Toutes ces manipulations ont été faites sur une Debian Squeeze en 64 bits.
## Installation du compilateur

### Dépendances
A exécuter en root.

```
aptitude install autoconf gettext libglib2.0-dev libtool libxext-dev libdbus-1-dev build-essential ia32-libs
```

A noter que le package ia32-libs n'est obligatoire que si vous avez une distribution 64bits comme moi.
### Téléchargement et installation

A exécuter avec une utilisateur normal (non root). j'ai créé un répertoire src à la racine de mon répertoire home.

```
cd src
wget https://sourcery.mentor.com/public/gnu_toolchain/arm-none-linux-gnueabi/arm-2010q1-202-arm-none-linux-gnueabi-i686-pc-linux-gnu.tar.bz2
tar xvjf arm-2010q1-202-arm-none-linux-gnueabi-i686-pc-linux-gnu.tar.bz2
mv arm-2010q1/ CodeSourcery
export PATH=/home/vlad/src/CodeSourcery/bin/:${PATH}
```
### Test

```
arm-none-linux-gnueabi-g++ -v
```

La dernière ligne doit indiquer : Sourcery G++ Lite 2010q1-202
## Sources

*	http://code.google.com/p/kobo-plus/wiki/GettingStarted

*	http://www.mobileread.com/forums/showthread.php?p=2176378
