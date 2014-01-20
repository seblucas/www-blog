/*
Title: COPS 0.3.2
Description: 
Author: Sébastien Lucas
Date: 2013/03/03
Robots: noindex,nofollow
Language: fr
Tags: calibre,ereader,nginx,opds,php
*/
# COPS 0.3.2

Pour cette nouvelle version, beaucoup de petites choses et quelques nouvelles fonctionnalités :

*	[Voici COPS : Calibre OPDS PHP Serveur](/fr/oss/calibre-opds-php-server)

*	[Liste des changements](/fr/oss/calibre-opds-php-server-changelog)

La principale motivation de cette nouvelle version est la correction de quelques petites anomalies.

Au niveau des évolutions, la mise à jour des métadonnées met aussi à jour l'image de couverture ainsi qu'un identifiant permettant à Calibre de reconnaitre le livre.

J'ai aussi ajouté, à la demande d'un utilisateur, le fait d'automatiser le transfert de livre au format .kepub.epub pour les utilisateurs de Kobo (via le paramètre $config['cops_provide_kepub']).

A noter 3 patches de Tyler J. Wagner, une traduction Néerlandaise de Northguy et un joli bug détecté par Mariosipad, merci beaucoup à eux.

Pour l'avenir :

*	Un utilisateur m'a proposé de revoir l'interface HTML (pas très jolie je l'admet) pour la passer en HTML5 et CSS3.

*	J'ai quasiment terminé la refonte de l'internationalisation pour pouvoir mieux gérer le pluriel et me désolidariser des fichiers de traduction de Calibre2Opds.

Une fois ces deux éléments terminés la version 1.0 ne sera pas loin.

Bon test à vous.
