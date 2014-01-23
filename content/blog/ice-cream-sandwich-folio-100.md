/*
Title: ICS (Ice Cream Sandwich) sur une Toshiba Folio-100
Description: 
Author: Sébastien Lucas
Date: 2012/03/13
Robots: noindex,nofollow
Language: fr
Tags: android
*/
# ICS (Ice Cream Sandwich) sur une Toshiba Folio-100

## Merci Toshiba :(
Pour rappel la Folio 100 est une tablette basée sur un processeur Nvidia Tegra 2 avec 512Mo de RAM. Elle était initialement fournie avec un OS basé sur Android mais dérouillé par Toshiba (pas d'accès au Market mais seulement au Toshiba Market). J'avais acheté cette tablette car elle est facilement modifiable et il y a un grande communauté qui travaille autour (heureusement que j'ai fait ce choix car Toshiba l'a totalement abandonné par la suite). 

J'ai d'abord utilisé la FolioMod et ensuite une vraie Cyanogenmod 7 (donc Gingerbread). Cette dernière était d'une stabilité exemplaire mais par contre l'OS était vraiment pas adapté pour les tablettes c'est pourquoi j'ai voulu tenter l'aventure ICS.

## Sources

Je ne suis qu'un banal utilisateur éclairé pour cette installation, mes sources sont les suivantes :

*	Pour la ROM : [ici en anglais](http://forum.xda-developers.com/showthread.php?t=1470823) et [là en français](http://forum.frandroid.com/topic/90378-devwip-ics-cm9-403-alpha-3-31-kernel-last-update-04032012/)

*	Pour la partie fastboot : http://forum.xda-developers.com/showthread.php?t=1055754

*	Une mine d'or de tutoriels dans tous les sens : http://forum.frandroid.com/topic/45847-maxi-tuto-gestions-des-rom-pour-les-debutants/

*	Fastboot pour la Folio : http://forum.xda-developers.com/showthread.php?t=1103479

*	Fastboot Android : http://android-dls.com/wiki/index.php?title=Fastboot
## Installation

### Téléchargement
Dans ce lien il faut télécharger les fichiers suivants (pour la version Alpha 4 à la date de l'écriture de ce billet) :

*	Le gestionnaire de boot : cwm-recovery-5.5.0.4.img

*	La ROM : update-cm-9.0.0-RC0-2012.03.04-betelgeuse-KANG-signed.zip

*	Les outils Google : gapps-ics-20120224-signed.zip

Les deux derniers fichiers doivent être copiés sur une carte SD.
### Sauvegarde de la tablette

Attention cette installation va totalement effacer votre tablette (carte SD interne comprise). Donc utilisez bien votre meilleur outil de sauvegarde (Titanium backup par exemple).
### Mise en place de fastboot sous Linux

#### Pourquoi Linux ?
J'ai essayé fastboot sous Windows (voir le Mega tuto dans les sources) et comme il faut obligatoirement installer un driver et que cela ne semblait pas être limpide, j'ai préféré le tenter sous Linux.
#### Téléchargement du programme

En premier téléchargez ce fichier :

[fastboot.bz2](/blog/fastboot.bz2)

Il faut ensuite le décompresser et lui donner les droits d’exécution :
```
bunzip2 fastboot.bz2
chmod +x fastboot
```

Vous pouvez ensuite le tester :
```
./fastboot
```
#### Paramétrage de udev pour que la tablette soit reconnue

En root, ajoutez ce fichier dans /etc/udev/rules.d/ :
```
SUBSYSTEMS=="usb", ATTRS{idVendor}=="0955", MODE="0666", OWNER="monUtilisateur"
```

En remplaçant monUtilisateur pour votre login préféré.
#### Démarrage de la Folio 100 en mode fastboot

Simple : 

*	Démarrer la tablette normalement

*	A l'apparition du logo Toshiba, taper 3 fois sur le bouton Power et ensuite le bouton Volume+

*	Un petit message confirme le passage en mode fastboot

*	Brancher la tablette via le port mini USB sur votre ordinateur

Attention ne pas appuyer 4 fois sur le bouton Power cela peut bloquer la tablette.
#### Test de bon fonctionnement

Taper : 
```
./fastboot devices
```

Il doit retourner une ligne avec plein de ????? qui montre que ça marche.
### Formatage de la tablette et installation du recovery

```
./fastboot -w
./fastboot flash recovery  cwm-recovery-5.5.0.4.img
```
### Redémarrage de la tablette et lancement du recovery

*	Insérez votre carte SD dans la Folio

*	Au démarrage de la tablette enter dans le recovery Toshiba avec Power + Volume+

*	Ensuite faire 3 x Volume+ pour enter dans Clockworkmod Recovery

*	Sélectionner install zip from sdcard et select zip from sdcard

*	Installer d'abord le fichier update-cm et ensuite les Gapps

*	redémarrer
## Profiter

Pour l'instant j'apprécie, reste à voir la suite.
