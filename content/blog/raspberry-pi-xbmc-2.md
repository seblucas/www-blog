/*
Title: Installation de XBMC sur le Raspberry Pi - 1 mois après
Description: 
Author: Sébastien Lucas
Date: 2012/10/14
Robots: noindex,nofollow
Language: fr
Tags: rpi
*/
# Installation de XBMC sur le Raspberry Pi - 1 mois après

Comme indiqué dans l'[article précédent](/blog/raspberry-pi-xbmc-1), mon choix s'est porté sur Raspbmc à l'époque en version RC4. Il avait l'avantage de bien gérer ma télécommande de Xbox.

Je vais faire un petit déballage de tout ce que j'ai pu lire ou appliquer sur ce dernier mois. Ca va être un peu façon bloc-notes mais les informations y seront.

## Fusion de la branche Raspberry Pi dans XBMC

Bonne nouvelle : http://xbmctech.com/2012/09/xbmc12-0-pre-frodo-adds-pvr-and-raspberry-pi/

## Raspbmc RC5

Après de longues semaines d'attente, La [version RC5 de Raspbmc](http://www.raspbmc.com/2012/10/raspbmc-release-candidate-5-released/) est enfin sortie et comme je suis quelqu'un de précautionneux j'ai attendu quelques jours avant de l'installer.

Heureusement car au final comme elle se base sur sur la branche principale de XBMC et sur la dernière version de Raspbian il y a eu beaucoup de petits et gros problèmes.

Les problèmes qui m'ont touché directement :
* La lecture de flux RTSP venant de la Freebox ne fonctionne plus.
* Certaines videos ont des soucis d'aspect ratio.
* La gestion de la télécommande de la Xbox est imprécise : beaucoup de répétitions de touches.
* La gestion de l'overclocking intégré avec l'application Raspbmc ne fonctionne pas : j'ai utilisé ce bon vieux vi.
* Le scrapper de film XBMC a une mauvaise traduction française ce qui fait qu'au lieu d'avoir "Film", il y un texte super long qui n'a rien à voir.
* J'ai eu des plantages.

Au final, comme le développeur de Raspbmc le fait remarquer beaucoup de choses viennent de XBMC ou Raspbian et ne sont pas de sa responsabilité. Mais pour mon utilisation quotidienne cette version n'est pas utilisable.

## Chérir son installation de Raspbmc RC4

Comme indiqué précédemment c'est la version de production chez moi. Et un soir, elle a voulu se mettre à jour. Je n'ai pas été assez rapide pour enlever le câble réseau et au final je me suis retrouvé avec un XBMC qui ne fonctionnait plus.

Je me suis donc connecté en SSH (user pi/raspberry) et j'ai exécuté les commandes suivantes : 

```
sudo initctl stop xbmc
sudo rm -rf /opt/xbmc-bcm
sudo wget http://raspbmc.com/downloads/bin/xbmc/xbmc-rbp-20120805.tar.gz -O /tmp/xbmc-rbp-20120805.tar.gz
sudo tar xzf /tmp/xbmc-rbp-20120805.tar.gz -C /opt
sudo rm /tmp/xbmc-rbp-20120805.tar.gz
sudo ldconfig
sudo initctl start xbmc
touch /home/pi/.noupgrades
```

## Flamewar entre Raspbmc et XBian ?

Honnêtement je n'ai pas d'avis, mais si vous voulez rire, faites des recherches sur ce sujet. Moi ça m'amuse ;).

## OpenElec ?

Cette distribution a un beau potentiel. J'ai réussi à compiler sans problème ma propre version en suivant le [tutoriel officiel](http://wiki.openelec.tv/index.php?title=Building_and_Installing_OpenELEC_for_Raspberry_Pi). Le gros avantage de la compilation est qu'il est possible de modifier le fichier projets/RPi/options pour enlever plein de choses inutiles (pour moi) :
* Support DVD et Bluray
* Encodeurs audio
* Modules additionnels de noyau pour carte Wifi ou DVB
* Avahi, Airplay, ...

Un des gros désavantages relevé il y a un mois était que ma télécommande n'était pas supportée. J'ai réussi à modifier la configuration pour qu'elle soit utilisable (le détail dans un prochain article).

Par contre, OpenElec a les mêmes défauts que la version RC5 de Raspbmc sur la gestion des flux RTSP, etc (ce sont bien des bugs d'XBMC).

A noter qu'il existe un fork d'OpenElec pour le Raspberry Pi : [](http://darkimmortal.com/2012/08/darkelec-release-2/). Il ne semble pas mis à jour depuis 2 mois.

## Gestion du Passthrough pour l'AC3 et le DTS

Pas d'avancées pour le moment, je pense que je vais me tourner vers le remplacement de mon ampli par une version avec HDMI. On verra.
