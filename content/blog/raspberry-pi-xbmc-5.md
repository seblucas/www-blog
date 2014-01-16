/*
Title: XBMC sur le Raspberry Pi - Raspbmc RC5 / 2ième
Description: 
Author: Sébastien Lucas
Date: 2012/11/25
Robots: noindex,nofollow
*/
# XBMC sur le Raspberry Pi - Raspbmc RC5 / 2ième

Une nouvelle version de Raspbmc est sortie (voir [ici](http://www.raspbmc.com/2012/11/new-with-raspbmc/)). Elle s'appelle toujours RC5 (ce qui ne va arranger la bonne compréhension des choses) mais elle apporte pas mal de choses.


## La liste des changements

*	XBMC est officiellement en beta (voir http://xbmc.org/natethomas/2012/11/15/xbmc-12-0-frodo-beta-1/).

*	Les disques externes rentrent en hibernation après 20 minutes d'inactivité.

*	Les dernières version d'XBMC limitent le rendu des menus à un résolution 720p (qui est ensuite agrandie à votre résolution normale). Cela permet d’accélérer le rendu et d'alléger la charge mémoire sur le GPU du Raspberry Pi. Cette limitation est désactivable via l'outil de configuration Raspbmc.

*	Des images complètes sont disponibles en téléchargement.

*	Bibliothèque CEC mise à jour en version 2.0.4

*	Meilleur support du PVR.

*	Amélioration du rendu des images (pour information avec la RC4 l'affichage d'une image en 8 Mégapixel fait planter le Pi).

*	Plus de swap.

*	Correction des problème d'appui doublé sur les télécommandes.

*	Le noyau est maintenant en 3.6.

## Mon cas à moi

Par rapport à ma liste de problèmes (voir [XBMC sur le Raspberry Pi - Raspbmc RC5](blog/raspberry-pi-xbmc-4)), les avancées sont les suivantes : 

*	Ma télécommande Xbox est de nouveau complètement utilisable

*	Plus de plantage au scan de répertoires.

Par contre, j'ai encore eu des écrans noirs en fin de lecture de flux RTSP venant de la Freebox. Cela se produit alors que je viens d'appuyer sur le bouton stop. La connexion en SSH est toujours possible mais cela rend encore la version RC5 inapte au remplacement de la RC4.

J'ai aussi remarqué que l'heure affiché dans XBMC n'était pas correct.

Sinon je dois avouer que la RC5 est vraiment plus rapide et plus agréable dans son interface.

Concernant les problèmes de sortie SPDIF, j'ai fini par acheter un nouvel ampli avec entrée HDMI (Yamaha RX-V473) et cela fonctionne très bien avec le Pi. J'en parlerai dans un futur article. 


