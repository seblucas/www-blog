/*
Title: Android : Jelly Bean sinon rien
Description: 
Author: Sébastien Lucas
Date: 2012/10/25
Robots: noindex,nofollow
Language: fr
Tags: android
*/
# Android : Jelly Bean sinon rien

Comme je l'ai déjà laissé entendre dans mes précédents articles sur Android, j'ai un Galaxy S et une tablette Folio 100. J'ai la chance que ces deux périphériques soient parfaitement supportés par la communauté j'ai donc accès à Jelly Bean (Android 4.1.X) via la Cyanogenmod 10 (CM10).

## Galaxy S

Suite à mon précédent article sur le sujet ([Passage à Ice Cream Sandwich avec mon Samsung Galaxy S - L'installation](/blog/galaxy-s-ics)), j'ai continué à suivre les différentes version de [SlimICS](http://slimroms.net/) jusque sa dernière version.

En septembre je suis passé à SlimBean (le lien est le même) et le changement a été vraiment simplissime et sans douleur.

La ROM marche vraiment bien et j'y trouve les avantages suivants :

* Meilleure autonomie.
* Interface plus jolie avec des transitions utilisant le GPU. 
* Le bureau par défaut gère parfaitement le passage en paysage.

Le seul défaut que je trouve pour le moment est que la nouvelle gestion de la reconnaissance vocale bloque l'utilisation de Voice Speed Dial. Mais au fond cela n'est pas très important

## Folio 100

### Rappel
Comme indiqué dans mes précédents article le passage à ICS avait été une bénédiction pour le Folio 100. Dernièrement [DerArtem](https://blog.slucas.fr/blog/ice-cream-sandwich-folio-100) a sorti des versions basées sur Jelly Bean et je dois dire que c'est une réussite.

**ATTENTION** : Les explications qui vont suivre vont effacer complètement votre tablette (y compris les données de la SD interne), veuillez donc faire les sauvegardes appropriées au préalable.

### Mise en place de Fastboot

Voir : [ICS (Ice Cream Sandwich) sur une Toshiba Folio-100](/blog/ice-cream-sandwich-folio-100).

### Téléchargement

A la date d'écriture de cet article, la dernière version est l'Alpha 4

* [recovery-cwm-CM10-A3.img](https://github.com/downloads/DerArtem/android_device_toshiba_betelgeuse/recovery-cwm-CM10-A3.img)
* [cm-10-20121021-UNOFFICIAL-betelgeuse.zip](https://github.com/downloads/DerArtem/android_device_toshiba_betelgeuse/cm-10-20121021-UNOFFICIAL-betelgeuse.zip)
* [formatsd.zip](https://github.com/downloads/DerArtem/android_device_toshiba_betelgeuse/formatsd.zip)
* [gapps-jb-20120726-signed.zip](http://goo.im/gapps/gapps-jb-20120726-signed.zip)

Les 3 derniers fichiers doivent être mis sur une carte SD insérée dans la Folio.

### Mise à jour du recovery

Démarrer la tablette en mode fastboot :

* Démarrer la tablette normalement
* A l'apparition du logo Toshiba, taper 3 fois sur le bouton Power et ensuite le bouton Volume+
* Un petit message confirme le passage en mode fastboot
* Brancher la tablette via le port mini USB sur votre ordinateur

Sur l'ordinateur exécuter les commandes suivantes :

```
./fastboot erase userdata
./fastboot erase system
./fastboot erase cache
./fastboot erase linux
./fastboot erase recovery
./fastboot flash recovery recovery-cwm-CM10-A3.img


./fastboot reboot
```

Pour la commande qui flashe le recovery, il faut bien sur avoir recopié le fichier img dans le répertoire courant ou adapter la commande.

### Installation

Au reboot, aller dans le recovery :

* Au démarrage de la tablette enter dans le recovery Toshiba avec Power + Volume+
* Ensuite faire 3 x Volume+ pour enter dans Clockworkmod Recovery

Il faut ensuite :

* Aller dans "mounts and storage"> et choisir 
    * "format /cache",
    * "format /data",
    * "format /system",
    * "format /emmc".
* Ensuite installer les zip dans l'ordre suivant : 
    * formatsd.zip
    * cm-10-20121021-UNOFFICIAL-betelgeuse.zip
    * gapps-jb-20120726-signed.zip

Un petit reboot et c'est terminé.

### Retour d'utilisation

La passage sous ICS avait été un grand pas en avant pour la Folio 100, mais je pense que Jelly Bean est encore mieux adapté.

Pour l'instant aucun problème, j'ai l'impression que le Wifi (le point faible de la Folio) accroche mieux.

## Un petit coup de gueule qui ne servira à rien

La semaine dernière, j'ai lu une annonce de Sony indiquant les téléphones allant recevoir la mise à jour en Jelly Bean (à lire [ici](http://www.frandroid.com/actualites-generales/114278_sony-annonce-les-smartphones-qui-auront-droit-a-jelly-bean-les-xperia-2011-resteront-sur-ice-cream-sandwich/) par exemple). J'en ai profité pour charrier copieusement un collègue qui possède un Xperia S.

Mais sur le fond, l'excuse de Sony pour expliquer que les modèles 2011 ne recevront pas la mise à jour est inacceptable : « nous ne sommes pas en mesure de garantir aux utilisateurs l’expérience qu’ils demandent et que nous exigeons ». 

Mon Samsung Galaxy S est sorti en 2010, il ne possède que 512Mo de RAM et je peux attester que Jelly Bean fonctionne parfaitement bien. J'irais même plus loin : aussi bien le téléphone que la tablette fonctionnent mieux avec Jelly Bean qu'avec le version d'Android fournie initialement par Samsung ou Toshiba.

Sony ferait mieux de donner la vraie explication : " Notre budget limité nous interdit d'allouer des ressources sur le maintien de téléphones vieux de plus d'un an et nous refusons catégoriquement de diffuser la moindre documentation ou driver lié à nos téléphones pour que la communauté se charge du boulot "

A noter que Sony est loin d'être le seul dans ce cas et aurait pu être remplacé par beaucoup d'autres noms de constructeurs.

Personnellement, mon prochain téléphone sera soit un Nexus (de Google) ou un téléphone sur lequel je serai certain de faire tourner CM10. C'est le seul moyen de s'assurer un support (normal selon moi) des mises à jour de l'OS.
