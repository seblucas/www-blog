---
title: "COPS 0.6.2"
date: 2013-09-13
tags: [calibre,ereader,nginx,opds,php]
slug: cops-0.6.2
disqus_identifier: /blog/cops-0.6.2
---
# COPS 0.6.2

Quelques corrections de bugs et quelques évolutions pour cette nouvelle version :

* [Voici COPS : Calibre OPDS PHP Serveur](/fr/projects/calibre-opds-php-server)
* [Liste des changements](https://github.com/seblucas/cops/blob/master/CHANGELOG)

Au programme, une grosse correction d'anomalie pour les Sony PRS-TX, Kindle et Cybook qui devraient fonctionner de nouveau. J'ai aussi corrigé de nombreuses petites régressions qui devraient stabiliser les choses.

Il y a une grosse évolution dans la gestion des miniatures. En installant COPS sur un NAS (ou tout autre appareil limité en CPU comme un Dockstar, Raspberry Pi, ...), le plus gros ralentissement vient de la génération des miniatures (qui se fait en live). Maintenant si COPS est sur votre NAS et que vous utilisez majoritairement COPS à partir de votre réseau local, alors donnez la valeur "1" au paramètre $config['cops_thumbnail_handling'] (dans le config_local.php bien sur). Cela aura pour effet de charger le réseau au lieu de charger le CPU. Vous pouvez en lire plus dans le fichier confog_local.php. A noter que cela m'a été inspiré par [un tutoriel d'installation pour Piratebox](http://forum.daviddarts.com/read.php?8,7921,7921).

Comme d'habitude merci à tous les contributeurs et testeurs.

Bon test à vous.
