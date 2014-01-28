/*
Title: Installation de XBMC sur le Raspberry Pi - Les choix
Description: 
Author: Sébastien Lucas
Date: 2012/09/01
Robots: noindex,nofollow
Language: fr
Tags: rpi
*/
# Installation de XBMC sur le Raspberry Pi - Les choix

## Principe général
Comme je l'ai dit dans mon précédent article, mon Raspberry Pi est arrivé il y a environ une semaine et mon objectif était d'avoir un média center (avec XBMC).

Heureusement la communauté est très vaste et nous avons pas mal de choix. Tous les choix ci-dessous se reposent sur le programme omxplayer qui utilise le décodage matériel du Pi. Toutes ces distributions se basent sur la Raspbian et donc un noyau supportant l'unité à virgule flottante (armhf).

Je ferai un autre article sur l'installation proprement dite de ces distributions plus tard.

J'ai à chaque fois essayé avec ma télécommande Xbox 1 avec un adaptateur USB et connecté à un écran en 1920x1200. Dans tous les cas le Pi devait convertir les flux AC3 / DTS en stéréo.

## Choix n°1 : OpenELEC

### Carte d'identité
*	Site Internet : http://openelec.tv/
*	Forum : http://openelec.tv/forum/124-raspberry-pi
*	Téléchargement : http://openelec.thestateofme.com/ ou http://sparky0815.de/openelec-download-images-fat-files/
*	username: root
*	password: openelec
*	Overclock par défaut : non
  
OpenELEC est une distribution déjà très connue autour d'XBMC. Cette distribution a été faite à la base pour les processeurs x86 et a ensuite été adapté aussi sur Apple TV. Elle est basée sur un Linux et est très optimisée (elle ne prends qu'environ 70Mo).

### Test

L'installation et le paramétrage de Xbmc s'est bien passé mais vu que ma télécommande n'a pas été détectée (même si le module lirc_xbox est bien détecté), j'ai du me connecter en SSH et activer le serveur Web :
*	Se connecter en SSH
*	Éditer la configuration :

```
vi ~/.xbmc/userdata/guisettings.xml
```
*	Changer la ligne suivante :

```
<webserver>true</webserver>
```
*	Redémarrer le Pi ou uniquement XBMC
  
J'ai ensuite pu configurer via l'interface Web (http://IP). J'ai aussi pu vérifier avec top la consommation pendant mes tests.

### Bilan

Avantages :
*	Vu la faible taille de l'installation peut se faire sur une carte de 1Go
*	Simple à compiler soit même sur un PC normal pour aller un peu plus vite
*	Mise à jour de version documenté et simple d'utilisation
  
Inconvénients :
*	Télécommande ne fonctionne pas 
*	Lenteur dans les menus
*	xbmc.bin consomme beaucoup de CPU (entre 80 et 90% de CPU dans un menu)

## Choix n°2 : Xbian

### Carte d'identité
*	Site Internet : http://xbian.org/
*	Forum : http://forum.xbian.org/
*	Téléchargement : http://xbian.org/?page_id=21
*	username: root
*	password: raspberry
*	Overclock par défaut : oui (overclock assez important ne fonctionnant pas sur tout les Pi)
  
Xbian est une distribution basée sur la Raspbian se prétendant la distribution la plus rapide. Les sources / modifications ne sont pas clairement accessibles.

### Test

L'installation et le paramétrage de Xbmc s'est bien passé mais vu que ma télécommande n'a pas été détectée (aucun module de détecté). On a une vrai impression de fluidité à l'utilisation.

### Bilan

Avantages :
*	Menus rapides
*	xbmc.bin consommme peu de CPU (entre 40 et 50% de CPU dans un menu)
  
Inconvénients :
*	Télécommande ne fonctionne pas (aucun support de LIRC pour le moment)
*	Manque de clarté sur les modifications et le respect de la GPL
*	Installation lourde (carte 2Go minimum)
*	Pas de système de mise à jour automatique

## Choix n°3 : Raspbmc

### Carte d'identité
*	Site Internet : http://www.raspbmc.com/
*	Forum : http://forum.stmlabs.com/forumdisplay.php?fid=6
*	Téléchargement : http://www.raspbmc.com/download/
*	username: pi (utiliser sudo pour le root)
*	password: raspberry
*	Overclock par défaut : oui
  
Raspbmc est une distribution basée sur la Raspbian. Les sources / modifications sont clairement accessibles et cette distribution a un système de mise à jour automatique bien fait

### Test

L'installation et le paramétrage de Xbmc s'est bien passé y compris la télécommande. On a une vrai impression de fluidité à l'utilisation malgré le temps de boot un peu plus long que Xbian et OpenElec.

A noter qu'à l'installation toute la place disponible sur la carte SD est utilisée (sur Xbian c'est 2Go uniquement)

### Bilan

Avantages :
*	Menus rapides
*	xbmc.bin consomme peu de CPU (entre 30 et 40% de CPU dans un menu)
*	Télécommande fonctionnelle
*	Système de MAJ automatique
  
Inconvénients :
*	Installation lourde (carte 2Go minimum)

##  Choix n°4 : Raspbian + XBMC 

Je ne l'ai pas testé je vais donc en parler très rapidement. Il est aussi possible d'utiliser une Raspbian normale et y ajouter un [Xbmc compilé à la main](http://www.raspbian.org/RaspbianXBMC) ou [un package tout fait](http://www.raspberrypi.org/phpBB3/viewtopic.php?t=12455).

## Bilan

Pour optimiser mon WAF et bénéficier de la télécommande, j'ai choisi Raspbmc qui fonctionne plutôt pas mal. Le seul problème qu'il me reste à résoudre est la gestion de l'audio.

Ma télévision n'a pas de sortie SPDIF et mon ampli n'a pas d'entrée HDMI, avant le Raspberry Pi j'utilisais un PC avec une sortie DVI (plus un adaptateur HDMI) et une sortie coaxiale directement sur l'ampli (donc aucun problème avec l'AC3 et le DTS).

Si j'ai bien compris, les seules solutions que j'ai sont les suivantes :
*	Acheter une télévision avec une sortie SPDIF et valider le bon transfert du DTS / AC3 
*	Acheter un ampli avec entrée HDMI
*	Acheter un boitier permettant de sortir le son sur du SPDIF (comme [çà](http://cgi.ebay.fr/HDMI-PCM-7-1-5-1-Surround-Sound-Optical-Audio-Decoder-/350247931305?pt=US_Internet_Media_Streamers&hash=item518c674da9) par exemple)
*	Acheter une carte son USB ayant une sortie SPDIF et prier pour le support dans Raspbmc / XBMC. J'ai repéré les cartes suivantes qui ont un bon support Linux :
    * http://www.terratec.net/fr/produkte/Aureon_7.1_USB_136941.html
    * http://cgi.ebay.fr/Sweex-7-1-External-USB-Sound-Card-SC016-Powered-by-USB-/330769694993
    
Je dois avouer que je réfléchi intensément notamment à cause du prix du boitier HDMI -> SPDIF + HDMI mais je n'ai pas trouvé mieux (si vous avez trouvé mieux, merci de me le dire via les commentaires).    
