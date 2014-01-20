/*
Title: XBMC sur le Raspberry Pi - Raspbmc RC5
Description: 
Author: Sébastien Lucas
Date: 2012/11/03
Robots: noindex,nofollow
Language: fr
Tags: rpi,xbmc
*/
# XBMC sur le Raspberry Pi - Raspbmc RC5

J'ai refait un test complet de Raspbmc RC5 hier et cela avance dans le bon sens. J'ai donc fait une réinstallation complète (en reprenant l'image d'installation) et j'ai installé la nightly du 2 novembre 2012. J'ai repris la liste d'un précédent billet ([Installation de XBMC sur le Raspberry Pi - 1 mois après](/blog/raspberry-pi-xbmc-2)) et j'ai barré les problèmes n'existant plus :

*	`<del>`La lecture de flux RTSP venant de la Freebox ne fonctionne plus.`</del>`

*	`<del>`Certaines videos ont des soucis d'aspect ratio.`</del>`

*	La gestion de la télécommande de la Xbox est imprécise : beaucoup de répétitions de touches.

*	`<del>`La gestion de l'overclocking intégré avec l'application Raspbmc ne fonctionne pas : j'ai utilisé ce bon vieux vi.`</del>`

*	`<del>`Le scrapper de film XBMC a une mauvaise traduction française ce qui fait qu'au lieu d'avoir "Film", il y un texte super long qui n'a rien à voir.`</del>`

*	J'ai eu des plantages.

Le problème le plus perturbant est le dernier. J'ai en effet eu deux plantages d'XBMC lors de lecture de flux RTSP de la Freebox (à noter que l'accès SSH était toujours possible). Par contre avec la version RC5 initiale j'avais eu des plantages au scan de répertoire que je n'ai plus réussi à reproduire.

A noter que la lecture de contenu HD (720p avec DTS) est moins gourmande en CPU qu'avec la RC4. 

Pour conclure, la RC5 n'est toujours pas prête à passer en production mais on se rapproche.


