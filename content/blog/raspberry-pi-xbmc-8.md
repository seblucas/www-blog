/*
Title: Nouvelles d'OpenElec / Tvheadend / Raspberry Pi
Description: 
Author: Sébastien Lucas
Date: 2013/04/03
Robots: noindex,nofollow
Language: fr
Tags: rpi,xbmc
*/
# Nouvelles d'OpenElec / Tvheadend / Raspberry Pi

##  Dernières versions d'OpenElec 
Je vais commencer par la mauvaise nouvelle, je suis bloqué à la version d'OpenElec du 12 janvier compilée par Rbej (voir [XBMC sur le Raspberry Pi : Openelec RC1](https://blog.slucas.fr/blog/raspberry-pi-xbmc-7)).

Depuis ce moment toutes les versions que j'essaie posent problème sur les flux RTSP de la Freebox :
* Décalage de son constant
* Erreurs de décodage désagréables
  
J'essaie très régulièrement les dernières versions compilées par Rbej mais pour le moment sans trouver mon bonheur. Par contre, j'ai constaté quelques améliorations notables sur les dernières versions (si les flux Freebox ne vous intéressent pas) :
* La télécommande de la Xbox est reconnue nativement
* La consommation CPU est moindre
* La fluidité générale est meilleure
  
Bref, j'attends avec impatience la version ultime !

Si quelqu'un est intéressé, la version du 12 janvier est [ici](http://dl.free.fr/gZuDKQ3hY).

## Visionnage de la TV : Tvheadend

Dans mon passé de Geek, j'ai utilisé VDR pour regarder la télévision / bénéficier du Timeshifting, etc bien avant que des boitiers tout faits fleurissent partout. 

Frodo intègre une fonctionnalité de PVR qui permet donc de se lier avec serveur lui proposant des flux à afficher (VDR, MediaPortal, Tvheadend).

Pour pallier aux defauts de la dernière version sur le décodage RTSP, j'ai essayé d'utiliser Tvheadend. Je me suis retrouvé face à deux problèmes :
* Le lien entre les versions actuelles d'Xbmc pour Raspberry Pi et Tvheadend est pour le moment buggé. Je vous laisse lire ce [sujet sur le forum d'Xbmc](http://forum.xbmc.org/showthread.php?tid=148646).
* Tvheadend ne supporte pas le RTSP.
  
Concernant le dernier point, ce n'est plus totalement vrai grâce à un développeur Français qui a ajouté cette fonctionnalité. Je vous laisse consulter son [Github](https://github.com/Glandos/tvheadend).

Je ferai un tutoriel complet dans quelques jours.

## Choses en cours

### Une breadboard
J'ai fini par me laisser tenter par l'achat d'un breadboard avec deux objectifs principaux :
* Connecter un récepteur infra-rouge pour remplacer celui venant de la XBox.
* Ajouter un bouton de reboot pour arrêter de débrancher / rebrancher l'alimentation.

L'objectif est d'intégrer tous ces éléments dans ma boite existante pour avoir vraiment une solution clé en main.
  
En parallèle, j'aimerai éventuellement brancher un afficheur 2 lignes que j'utilisais sur mon VDR précédemment. 

### Récepteur infra-rouge

Pour le récepteur infra-rouge, j'ai récupéré quelques TSOP38238 qui correspondent au [LIRC GPIO driver](http://aron.ws/projects/lirc_rpi/). Pour le moment je n'ai pas encore testé mais tout est prêt.

### Un bouton de redémarrage après arrêt

J'ai trouvé des informations sur deux techniques :
* Utiliser le bornier P6 (voir [ici](http://raspi.tv/2012/making-a-reset-switch-for-your-rev-2-raspberry-pi))
* Utiliser deux broches du GPIO (voir [ici](http://elinux.org/RPI_safe_mode) et [là](http://www.raspberrypi.org/phpBB3/viewtopic.php?p=227308)).
  
Je préfère la deuxième méthode mais pour le moment seule la première fonctionne. Je pense donc souder directement deux fils connectés à un bouton poussoir vissé sur mon boitier.
