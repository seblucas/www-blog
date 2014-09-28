/*
Title: Banana Pi - Installation de la caméra
Description: 
Author: Sébastien Lucas
Date: 2014/09/28
Robots: noindex,nofollow
Language: fr
Tags: bpi
*/
# Banana Pi - Installation de la caméra

## Une caméra ?

De la même manière que le Raspberry Pi, le Banana Pi est équipé d'un port CSI dédié à la connexion d'une caméra. Lemaker nous a donc concocté une caméra compatible avec le Banana Pi ([la caméra du Raspberry Pi](http://www.raspberrypi.org/products/camera-module/) n'est pas compatible attention). J'ai eu la chance d'être [sélectionné](http://forum.lemaker.org/5456-1-1-banana_pi_camera_trial_application_name_list.html) pour faire partie des premiers chanceux à pouvoir la tester.

La caméra de face

![Caméra Face](/blog/BpiCameraFace.png){.centered}

et de dos

![Caméra Dos](/blog/BpiCameraDos.png){.centered}

## Le packaging

Je pense pas que la packaging soit définitif mais je l'ai reçue dans une boite cartonnée identique à celle de mon Banana Pi. Le contenu de la boite était :

 * Le module de caméra
 * Une nappe assez courte (environ 10cm)

## Installation

Je n'ai pas fait de photo ni vidéo mais l'installation a été assez simple. Il faut par contre faire très attention à la nappe : ne pas la plier et ne pas toucher les extrémités (sauf sur le côté bleu).

Le port CSI à utiliser est celui du côté de la carte SD, l'autre est un port LVDS. Ne soyez pas aussi bête que moi si vous avez un boîtier, mettez d'abord la nappe côté Banana Pi. Pour le fixer c'est très simple :

 * il faut remonter le haut du port CSI (en plastique gris), j'ai personnellement utilisé deux petits tournevis de précision (cela doit être possible avec les doigts).
 * Insérer la nappe, côté bleu vers le port réseau.
 * Abaisser le plastique gris pour la fixer.
 * Vérifier que tout est bien droit.

Comme j'ai un boîtier, j'ai d'abord refermé le haut et je me suis occupé du côté caméra. C'est grosso modo le même principe sauf que le système de fixation est différent, il y a un bout de plastique qui bascule à 90°.

## Chargement de modules

```bash
modprobe ov5640
modprobe sun4i_csi
```

Pensez à utilisez sudo si votre configuration l'exige.

## Premier test : fswebcam

La caméra est reconnue comme un périphérique V4L donc il existe beaucoup de logiciels pour l'utiliser. J'ai choisi [fswebcam](https://github.com/fsphil/fswebcam) pour commencer avec quelque chose de simple.

```bash
apt-get install libgd2-xpm-dev
wget http://www.sanslogic.co.uk/fswebcam/files/fswebcam-20140113.tar.gz
tar xvzf fswebcam-20140113.tar.gz
cd fswebcam-20140113
./configure
make -j 2
./fswebcam --resolution 1280x720 --flip v test.jpg
```

La paramètre `--flip` est présent uniquement car ma caméra est à l'envers (ce qui est le plus pratique vu la petite taille de la nappe).

## La qualité

Je ne peux pas me positionner pour le moment, les seuls tests que j'ai fait sont corrects, il faut voir ce que ça donne dans sa résolution native et en enregistrement vidéo.

# Bilan

Pas de bilan pour le moment il me reste beaucoup d'autre tests à effectuer, mais je suis déjà assez content de la simplicité de première utilisation ;).