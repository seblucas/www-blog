/*
Title: Deux Dockstar ... et après
Description: 
Author: Sébastien Lucas
Date: 2012/08/30
Robots: noindex,nofollow
*/
# Deux Dockstar ... et après

## Raspberry Pi ou A10
Suite à l'achat et l'utilisation de plusieurs Dockstar et la conversion de plusieurs collègues, j'ai continué à suivre ce petit monde afin de trouver la perle rare pour lui succéder. J'ai bien évidemment suivi le [Raspberry Pi](http://www.raspberrypi.org/) mais aussi tous les périphériques autour du [Allwinner A10](http://rhombus-tech.net/allwinner_a10/).

Je vais profiter de cet article pour donner toutes mes sources de renseignements et l'état de mes réflexions.

## Pour quelle utilisation

###  Serveur 
Mon Dockstar (petit serveur qui consomme 4W) est installé avec les services suivants : 

*	Serveur Web / PHP avec Nginx 

*	Serveur de téléchargement SABnzbd directement sur le NAS

*	Serveur de téléchargement sur les sites de DDL avec pyLoad

*	Serveur openVPN

*	Serveur UPNP (en conjonction avec le NAS)

Beaucoup d'autres services pourraient être ajoutés : 

*	Serveur de fichiers

*	Serveur MPD (avec une carte son USB ou non)

*	Serveur d'impression

*	Serveur de mail

*	Serveur cloud (avec owncloud par exemple)

*	Serveur SVN / GIT / Mercurial / ...

*	...
  
Pour toutes ces utilisations le Dockstar fait très bien le boulot, pas besoin d'un ordinateur qui consomme 90W pour ça.
### Client graphique / Video

Depuis quelques années les smartphones ont des GPU/VPU permettant :

*	de lire des vidéos (y compris HD),

*	de jouer à des jeux jolis (avec OpenGL ES),

*	d'avoir des interfaces graphiques accélérées. 

Suite à cela, beaucoup de petites machines ARM sont sorties avec sortie HDMI et la promesse d'accélération graphique. Je parle de promesse parce que la plupart du temps c'est le seul point dépendant d'un driver propriétaire donc souvent inaccessible simplement via un Linux tout simple.

Avec ce genre de machines on peut rêver à une utilisation de media center et tout ce qu'un serveur X apporte (consultation de mail, navigateur Internet, ...).

Pour les vieux de la vieille, j'ai encore une Xbox que j'avais acheté en priorité pour XBMC et qui a très bien rempli sa mission pendant des années. Remplacer une Xbox par une boite 5 fois plus petite et totalement silencieuse serait assez agréable.
## Raspberry Pi

Voir [ici](http://www.raspberrypi.org/) pour plus d'informations.

A vrai dire j'ai failli m'en acheter un pour remplacer un vieux portable qui me sert à regarder des vidéos et les flux RTSP de Free. Mais, la pénurie est telle (et j'ai souvent la flemme d'attendre au bon moment) que je n'ai jamais passé commande.

Pour les spécifications, je vous laisse consulter [la page Wikipedia](http://fr.wikipedia.org/wiki/Raspberry_Pi).  
Pour simplifier :

*	CPU : Arm11 à 700MHz avec support des nombres à virgule flottante.

*	256Mo de RAM

*	1 port réseau 100Mbits (dans le modèle B uniquement)

*	Decodage video H264 video maximum 1080p30

*	2 ports USB
  
On parle là d'une vraie petite machine bien qu'un peu plus faible qu'un Dockstar elle a la gestion des virgules flottante en plus. Le gros avantage est le support de Xbmc et une très grosse communauté. Le gros défaut est qu'il me manque au moins une sortie SPDIF (j'ai un vieil ampli) et j'aurais aimé un processeur un peu plus puissant.

Bref, bon support mais matériel un peu limite.
## Allwinner A10 - Mele A2000 ou bien d'autres sytèmes

Pour plus de détails voir :

*	http://rhombus-tech.net/allwinner_a10/

*	http://wiki.xbmc.org/index.php?title=Allwinner_A10_devices

*	http://forum.xbmc.org/showthread.php?tid=126995

*	http://forum.doozan.com/list.php?6

*	beaucoup d'autres sites (merci Google)
  
Un très très gros potentiel car les spécifications sont top :

*	CPU : 1.2ghz Cortex A8 ARM Core

*	Entre 512Mo et 1Go de RAM selon les modèles

*	1 port réseau 100Mbits

*	Un decodage video H264 de 4 flux 1080p donc support de la 3D

*	Port USB / Port SATA / Carte Wifi sur certaines versions / Sortie SPDIF / ...

*	...
  
Vous pouvez voir mes liens pour plus de détails. Je voulais m'en acheter un mais le problème est que le support du matériel est inclus uniquement dans Android et via des applications propriétaires. Un rapprochement est peut être en cours avec un développeur de XBMC mais je vais faire comme Saint Thomas et attendre de voir. Le prix est aussi très correct.

Bref, bon matériel mais mauvais support de Linux.
## XBMC pour Android

Depuis le mois de juillet XBMC est disponible sur Android (voir [ici](http://xbmc.org/theuni/2012/07/13/xbmc-for-android/). Attention en ce qui concerne l'accélération vidéo, cela ne concerne que les Pivos. Mais, cela laisse présager d'autres matériels compatibles.
## L'avenir

Beaucoup de périphériques ARM sont sur le point d'arriver sur le marché, très souvent avec Android. J'ai notamment repéré [Ouya](http://www.kickstarter.com/projects/ouya/ouya-a-new-kind-of-video-game-console) qui a bien monopolisé l'attention sur lui. Sur le papier on aurait une machine plus qu'intéressante (Tegra 3 donc une belle puissance brute : environ le décodage du 720p en soft) et qui [veut supporter Xbmc](http://xbmc.org/natethomas/2012/08/07/xbmc-and-ouya-oh-yeah/).
## Bilan

Il est urgent d'attendre.



Mais comme je suis pressé j'ai acheté un Raspberry Pi et je le teste assidument depuis une semaine. Je ferai quelques articles à ce sujet prochainement.
