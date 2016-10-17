/*
Title: Voici COPS : Calibre OPDS (et HTML) PHP Serveur
Description: 
Author: Sébastien Lucas
Robots: noindex,nofollow
Language: fr
Tags: calibre,ereader,nginx,opds,php
*/
# Voici COPS : Calibre OPDS (et HTML) PHP Serveur

## Pourquoi ?
Je pense que Calibre est un outil merveilleux mais il n'est pas adapté pour n'être utilisé que pour son serveur de contenu.

C'est pourquoi j'ai développé ce serveur OPDS / HTML. J'avais besoin d'un serveur simple pour être installé sur un petit serveur (un superbe Seagate Dockstar). tout cela dans le but de partager mes livres à tous les ordinateurs/tablettes/téléphones/liseuses de la maison.

J'avais initialement pensé Calibre2OPDS mais comme il génère des fichiers statiques il n'était pas possible de faire des recherches. De plus il fallait penser à relancer le traitement à chaque modification de la bibliothèque.

Donc les principaux avantages de COPS sont :
 * Peu de dépendances.
 * Pas besoin de beaucoup de CPU ou RAM.
 * Peu de code.
 * La recherche est possible.
 * Avec Dropbox / Owncloud, il est très simple d'avoir un serveur OPDS toujours à jour (voir [Alternative au serveur de contenu de Calibre](/blog/calibre-web-server-alternative)).
 * La code OPDS est 100% valide (vérifié avec http://opds-validator.appspot.com/).
 * Enfin c'était mon premier projet en PHP et c'était fun.

**ATTENTION**

COPS a été testé par des utilisateurs sur la plupart des serveurs Web (Nginx, Apache, Cherokee, Lighttpd, IIS) et il est aussi utilisé sur beaucoup de NAS (Synology, QNap, ReadyNas).

Mon catalogue COPS est protégé avec "Basic HTTP auth" et HTTPS. C'est suffisamment sécurisé pour moi (mais certainement pas le top).

Du côté OPDS je n'ai testé qu'avec Aldiko, Mantano Reader et FBReader sur Android (A noter que ces trois supportent le fait de protéger la catalogue par un utilisateur/mot de passe). J'ai aussi utilisé [Ibis Reader](http://ibisreader.com/), mais il ne supporte pas les mots de passe.
D'autres utilisateurs ont confirmé que COPS fonctionne avec Stanza, Megareader, Shubook and Bluefire.

Comme je l'ai dit plus haut c'était ma première expérience de codage en PHP et je dois avouer que ça se sent en lisant le code. Un jour il sera réécrit ;).

## Fonctionnalités

*	Interface HTML5 / CSS3 avec responsive design.
*	Supporte plusieurs base de données Calibre avec une seule installation de COPS.
*	Mise à jour des métadonnées des fichiers Epub comme le serveur de contenu de Calibre (à activer avec $config['cops_update_epub-metadata']) : Si vous avez corrigé le nom de l'auteur / une étiquette / le nom de la série d'un livre dans Calibre, alors le fichier que vous allez télécharger contiendra votre correction.
*	Colonne personnalisée de Calibre.
*	Facets dans le flux OPDS pour filtrer la liste des livres (les seuls clients OPDS le supportant sont Mantano Reader and Bluefire).
*	Multilangue : Catalan, Tchèque, Allemand, Anglais, Espagnol, Basque, Français, Haïtien (Creole), Hongrois, Italien, Norvégien (Bokmål), Néerlandais, Polonais, Portugais, Russe, Suédois, Ukrainien, Chinois.
*	beaucoup d'autres

## Démonstration

Si vous voulez l'essayer, vous pouvez faire pointer votre meilleur client OPDS sur :

http://cops-demo.slucas.fr/feed.php

Et votre navigateur : 

http://cops-demo.slucas.fr/index.php

## Pré-requis

*	PHP 5.3, 5.4, 5.5, 5.6 ou hhvm avec GD, Libxml, Intl, Json et le support SQLite3.
*	Un serveur Web avec le support PHP (Nginx, Apache, Cherokee, Lighttpd, IIS).
*	Le chemin vers la bibliothèque Calibre (metadata.db, images de couverture et fichier epub).

Sur toutes les distributions basées sur Debian, vous utiliser :

```
aptitude install php5-gd php5-sqlite php5-json php5-intl
```

## Installation

*	Extraire le zip dans un répertoire visible du serveur Web.
*	Pour une première installation copier config_local.php.example vers config_local.php
*	Modifier config_local.php pour l'adapter à votre configuration.
*	Si nécessaire ajouter des nouveaux paramétrages venant de config_default.php

## Problèmes connus

Aucune pour le moment. Si vous en avez un, alors saisissez là sur [Github](https://github.com/seblucas/cops/issues?state=open)

## En cas de problème ou question

Vérifiez le [Wiki](https://github.com/seblucas/cops/wiki).

Je vérifie ce [thread MobileRead](http://www.mobileread.com/forums/showthread.php?p=1988610) régulièrement (si la langue de Shakespeare ne vous rebute pas). Sinon il reste le mail (dans le bas de [cette page](/user/sebastien_lucas)).

## Envie de m'aider ?

Si vous aimez COPS et/ou que vous avez envie de m'aider, vous pouvez [m'offrir un verre](https://www.paypal.com/cgi-bin/webscr?cmd=_s-xclick&hosted_button_id=9CNHDRJ6GX2Z4). Cela ne sera utilisé que pour le bien !

J'ai notamment envie d'acheter une Kindle Paperwhite d'occasion pour corriger l'affichage de COPS.

## Téléchargement 

Ce projet est open source (GPL v2) et est accessible via [GitHub](https://github.com/seblucas/cops). Si vous voulez contribuer, vous pouvez envoyer des merge request via GitHub ou au pire des patches par mail (dans le bas de [cette page](/user/sebastien_lucas)).

Le fichier est ici ([Liste des changements](https://github.com/seblucas/cops/releases)):

[cops-1.0.1.zip](https://github.com/seblucas/cops/releases/download/1.0.1/cops-1.0.1.zip)

Vous pouvez télécharger les anciennes versions [ici](https://github.com/seblucas/cops/releases)

Si vous préférez un installation un peu plus automatique, COPS est aussi disponible avec Docker en version [x86](https://hub.docker.com/r/linuxserver/cops/) ou [Arm](https://hub.docker.com/r/lsioarmhf/cops/) grâce à l'équipe de [linuxserver.io](https://www.linuxserver.io/).