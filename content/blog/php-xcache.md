/*
Title: PHP XCache
Description: 
Author: Sébastien Lucas
Date: 2011/09/16
Robots: noindex,nofollow
*/
# PHP XCache

## Qu'est ce que c'est
[XCache](http://xcache.lighttpd.net/) est un outil permettant de mettre en cache (en mémoire vive) le résultat de la compilation des fichiers PHP. Cela entraine bien évidemment un gain en performance (en terme de CPU et d'I/O).
## Installation

	
	aptitude install php5-xcache

## Configuration

Tout est préparé par defaut (un petit phpinfo() permet de la confirmer), il reste juste à éditer /etc/php5/conf.d/xcache.ini pour modifier la ligne suivante :

	
	xcache.size = 16M

J'ai choisi 16Mo parce que mon serveur Web a peu de RAM (voir [Dockstar](blog/dockstar-install-squeeze)).

## Test

XCache inclus une interface d'administration permettant de valider le bon fonctionnement de l'installation et d'adapter finement le paramétrage. Voir le lien suivant pour plus d'informations : http://xcache.lighttpd.net/wiki/InstallAdministration

